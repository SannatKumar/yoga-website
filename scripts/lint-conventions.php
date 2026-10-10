<?php

/**
 * Project convention linter for the yoga-app.
 *
 * Checks the project-specific rules documented in docs/CONVENTIONS_*.md and
 * .claude/skills/yoga-app-conventions/SKILL.md that standard tools (Pint, php -l)
 * don't know about: route-name-matches-path, the asana()/asanas() singular/plural
 * relationship convention, the "never use a real pose photo as a generic fallback"
 * rule, migration filename/docblock conventions, and a couple of known open
 * cleanup items worth nagging about until they're resolved.
 *
 * Usage:
 *   php scripts/lint-conventions.php
 *
 * Exit code 1 if any ERROR-level violation is found, 0 otherwise. WARN-level
 * findings are printed but never fail the run.
 *
 * This is NOT a PHP style/formatting checker — run `vendor/bin/pint --test`
 * for that (see pint.json). This script only checks the conventions specific
 * to this project that a generic tool can't know about.
 */
$root = dirname(__DIR__);
$viewsDir = $root.'/resources/views';

/** @var array<int, array{level: string, file: string, line: int|null, message: string}> */
$findings = [];

function addFinding(array &$findings, string $level, string $file, ?int $line, string $message): void
{
    $findings[] = ['level' => $level, 'file' => $file, 'line' => $line, 'message' => $message];
}

function relPath(string $root, string $path): string
{
    return str_replace('\\', '/', substr($path, strlen($root) + 1));
}

// ---------------------------------------------------------------------------
// Check 1 & 2: routes/web.php — name() matches path, no old-style 'Controller@method'
// ---------------------------------------------------------------------------
$routesFile = $root.'/routes/web.php';
$definedRouteNames = [];
$parkedRouteNames = [];

// Pre-existing, intentional exceptions to "name matches path" — descriptive names
// chosen deliberately, predate that convention being written down. Not bugs.
$routeNameExceptions = ['teacher-profile', 'mantra-shloka-bhajan', 'mantra-shloka-bhajan-content'];

if (is_file($routesFile)) {
    $lines = file($routesFile);

    // Pass 1: every ->name('x') on a LIVE (non-commented) line defines a route,
    // regardless of whether the Route::get(...) call is on the same line — a
    // closure-bodied route (e.g. /set-locale/{locale}) has its ->name() call on
    // a different line than Route::get(, so this can't be a single-line regex.
    foreach ($lines as $line) {
        if (! preg_match("/->name\\('([^']+)'\\)/", $line, $m)) {
            continue;
        }
        if (str_starts_with(ltrim($line), '//')) {
            // Commented-out route — not registered, but deliberately parked
            // (see "Disabled-but-kept routes" in CONVENTIONS_ROUTES.md).
            $parkedRouteNames[$m[1]] = true;
        } else {
            $definedRouteNames[$m[1]] = true;
        }
    }

    // Pass 2: line-level checks that only make sense on single-line route defs.
    foreach ($lines as $i => $line) {
        $lineNo = $i + 1;
        $trimmed = ltrim($line);

        if (str_starts_with($trimmed, '//')) {
            continue; // deliberately-disabled route, not live — don't lint it
        }

        // Old-style 'Controller@method' string callable.
        if (preg_match("/Route::(get|post|put|delete|patch)\\([^,]+,\\s*'[A-Za-z0-9_\\\\]+@/", $line)) {
            addFinding($findings, 'error', 'routes/web.php', $lineNo,
                "uses old-style 'Controller@method' string callable — use [Controller::class, 'method'] instead");
        }

        // Route::get/post/put/delete/view('/path', ...)->name('name') on one line.
        if (preg_match("/Route::(?:get|post|put|delete|patch|view)\\(\\s*'([^']+)'.*?->name\\('([^']+)'\\)/", $line, $m)) {
            $path = $m[1];
            $name = $m[2];

            $expected = trim($path, '/');
            $expected = preg_replace('#/\{[^}]+\}#', '', $expected); // drop {id} etc.
            $expected = str_replace('/', '-', $expected);

            if ($expected !== '' && $expected !== $name && ! in_array($name, $routeNameExceptions, true)) {
                addFinding($findings, 'warn', 'routes/web.php', $lineNo,
                    "route path '{$path}' has name '{$name}', expected '{$expected}' (soft convention — route name usually matches its kebab-case path; see CONVENTIONS_ROUTES.md)");
            }
        }
    }

    // Known open item: unauthenticated, CSRF-exempt write routes.
    $csrfExemptCount = 0;
    foreach ($lines as $line) {
        if (str_contains($line, 'withoutMiddleware') && str_contains($line, 'VerifyCsrfToken')) {
            $csrfExemptCount++;
        }
    }
    if ($csrfExemptCount > 0) {
        addFinding($findings, 'warn', 'routes/web.php', null,
            "{$csrfExemptCount} unauthenticated, CSRF-exempt write route(s) still present — see DEPLOYMENT_TODO.md item 1 before any public deploy");
    }
} else {
    addFinding($findings, 'warn', 'routes/web.php', null, 'file not found — skipped route checks');
}

// ---------------------------------------------------------------------------
// Check: every route('name') call actually resolves to a route defined above.
// This is the check that would have caught the real gallery-asana-detail bug
// (a Blade view linking to a route name that didn't exist anywhere in web.php).
// ---------------------------------------------------------------------------
if (! empty($definedRouteNames)) {
    $searchRoots = [$viewsDir, $root.'/app'];
    foreach ($searchRoots as $dir) {
        $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS));
        foreach ($rii as $file) {
            if (! preg_match('/\.(php)$/', $file->getFilename())) {
                continue;
            }
            $content = file_get_contents($file->getPathname());
            // Strip Blade comments ({{-- ... --}}, possibly multi-line) so a
            // deliberately-disabled nav link isn't flagged as a live bug.
            $content = preg_replace('/\{\{--.*?--\}\}/s', '', $content);
            $lines = explode("\n", $content);
            foreach ($lines as $i => $line) {
                if (str_starts_with(ltrim($line), '//')) {
                    continue; // commented-out PHP line
                }
                if (preg_match_all("/route\\(\\s*['\"]([a-z0-9\\-]+)['\"]/", $line, $matches)) {
                    foreach ($matches[1] as $usedName) {
                        if (! isset($definedRouteNames[$usedName]) && isset($parkedRouteNames[$usedName])) {
                            // Only reachable through the parked route's own controller,
                            // so it can't throw today — but it will if the view gets
                            // linked/rendered before the route is re-enabled.
                            addFinding($findings, 'warn', relPath($root, $file->getPathname()), $i + 1,
                                "route('{$usedName}') points at a parked (commented-out) route — re-enable it in routes/web.php before linking to this view");
                        } elseif (! isset($definedRouteNames[$usedName])) {
                            addFinding($findings, 'error', relPath($root, $file->getPathname()), $i + 1,
                                "route('{$usedName}') does not match any route name defined in routes/web.php — this will throw RouteNotFoundException at runtime");
                        }
                    }
                }
            }
        }
    }
}

// ---------------------------------------------------------------------------
// Check 3: Blade pages mixing Tailwind utility classes with a hand-rolled <style> block
// ---------------------------------------------------------------------------
$knownExceptions = ['welcome.blade.php']; // documented, accepted exception — see CONVENTIONS_FRONTEND.md
$pageBladeFiles = glob($viewsDir.'/*.blade.php') ?: [];
foreach ($pageBladeFiles as $file) {
    $basename = basename($file);
    if (in_array($basename, $knownExceptions, true)) {
        continue;
    }
    $content = file_get_contents($file);
    // Ignore commented-out markup ({{-- --}} and <!-- -->) — it isn't rendered,
    // so dead classes inside a comment can't cause a layout bug.
    $content = preg_replace(['/\{\{--.*?--\}\}/s', '/<!--.*?-->/s'], '', $content);
    // Only count a <style> block that actually has non-whitespace CSS in it —
    // a few pages have a leftover empty <style></style> tag that doesn't count.
    $hasStyleBlock = false;
    if (preg_match('/<style>(.*?)<\/style>/s', $content, $styleMatch)) {
        $hasStyleBlock = trim($styleMatch[1]) !== '';
    }
    $tailwindHits = preg_match_all('/class="[^"]*\b(?:flex|grid|px-\d|py-\d|bg-[a-z]|text-[a-z]|rounded-[a-z]|gap-\d|justify-|items-)/', $content);

    if ($hasStyleBlock && $tailwindHits >= 3) {
        // 'grid'/'flex'/'items-'/'justify-' style hits also match Bootstrap-style
        // utility classes (row, col-12, d-flex, g-4) — check for those specifically,
        // since this project has no Bootstrap dependency at all (confirmed: no
        // bootstrap reference in package.json or any layout file), which would
        // make them silently do nothing rather than just "mix two systems."
        $looksBootstrap = (bool) preg_match('/class="[^"]*\b(?:row|col-\d|d-flex|g-\d)\b/', $content);
        if ($looksBootstrap) {
            addFinding($findings, 'error', relPath($root, $file), null,
                'uses Bootstrap-style grid classes (row/col-*/d-flex/g-*) alongside a <style> block, but this project has no Bootstrap CSS loaded anywhere — these classes are likely dead/no-op. Verify the intended layout and either load Bootstrap or replace with real CSS/Tailwind.');
        } else {
            addFinding($findings, 'warn', relPath($root, $file), null,
                "mixes Tailwind utility classes ({$tailwindHits} hits) with a <style> block — pick one layout style per page (see CONVENTIONS_FRONTEND.md)");
        }
    }
}

// ---------------------------------------------------------------------------
// Check 4: a real pose photo used as a generic "no image" fallback
// ---------------------------------------------------------------------------
$searchDirs = [$viewsDir, $root.'/app'];
$approvedFallback = '/lotus-images/';
foreach ($searchDirs as $dir) {
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS));
    foreach ($rii as $file) {
        if (! preg_match('/\.(php)$/', $file->getFilename())) {
            continue;
        }
        $lines = file($file->getPathname());
        foreach ($lines as $i => $line) {
            if (preg_match("/\\?\\?\\s*'(\\/images\\/[^']+)'/", $line, $m)) {
                if (! str_contains($m[1], $approvedFallback)) {
                    addFinding($findings, 'error', relPath($root, $file->getPathname()), $i + 1,
                        "falls back to a specific photo ('{$m[1]}') for a missing image — use '/lotus-images/blank_image.png' as the generic fallback instead (see CONVENTIONS_FRONTEND.md, 'Fallback images')");
                }
            }
        }
    }
}

// ---------------------------------------------------------------------------
// Check 5 & 6: migration filename pattern + data-only migration disclosure
// ---------------------------------------------------------------------------
$migrationsDir = $root.'/database/migrations';
$migrationFiles = glob($migrationsDir.'/*.php') ?: [];
foreach ($migrationFiles as $file) {
    $basename = basename($file);
    if (! preg_match('/^\d{4}_\d{2}_\d{2}_\d{6}_[a-z0-9_]+\.php$/', $basename)) {
        addFinding($findings, 'error', relPath($root, $file), null,
            'migration filename does not match the expected YYYY_MM_DD_HHMMSS_snake_case_name.php pattern');
    }

    $content = file_get_contents($file);
    $hasSchemaCall = str_contains($content, 'Schema::');
    if (! $hasSchemaCall && str_contains($content, 'DB::table')) {
        if (! stripos($content, 'data-only migration')) {
            addFinding($findings, 'warn', relPath($root, $file), null,
                "looks like a data-only migration (DB::table inserts, no Schema:: calls) but doesn't say so in its docblock — add a \"Data-only migration (no schema change): ...\" note (see CONVENTIONS_DATABASE.md)");
        }
    }
}

// ---------------------------------------------------------------------------
// Check 7: asana()/asanas() singular-belongsTo vs plural-hasMany convention
// ---------------------------------------------------------------------------
$modelsDir = $root.'/app/Models';
$modelFiles = glob($modelsDir.'/*.php') ?: [];
foreach ($modelFiles as $file) {
    $content = file_get_contents($file);
    if (preg_match_all('/public function (asana|asanas)\(\)\s*\{(.*?)\n\s*\}/s', $content, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $match) {
            $methodName = $match[1];
            $body = $match[2];
            $isBelongsTo = str_contains($body, 'belongsTo(Asana::class');
            $isHasManyOrBelongsToMany = str_contains($body, 'hasMany(Asana::class') || str_contains($body, 'belongsToMany(Asana::class');

            if ($methodName === 'asana' && $isHasManyOrBelongsToMany) {
                addFinding($findings, 'error', relPath($root, $file), null,
                    'method asana() uses hasMany/belongsToMany — singular method names are reserved for belongsTo (see CONVENTIONS_FUNCTIONS.md)');
            }
            if ($methodName === 'asanas' && $isBelongsTo) {
                addFinding($findings, 'error', relPath($root, $file), null,
                    'method asanas() uses belongsTo — plural method names are reserved for hasMany/belongsToMany (see CONVENTIONS_FUNCTIONS.md)');
            }
        }
    }
}

// ---------------------------------------------------------------------------
// Check 8: known, tracked open cleanup item — duplicate addAsanas()
// ---------------------------------------------------------------------------
$galleryHasAddAsanas = is_file($root.'/app/Http/Controllers/GalleryController.php')
    && str_contains(file_get_contents($root.'/app/Http/Controllers/GalleryController.php'), 'function addAsanas(');
$testHasAddAsanas = is_file($root.'/app/Http/Controllers/TestController.php')
    && str_contains(file_get_contents($root.'/app/Http/Controllers/TestController.php'), 'function addAsanas(');
if ($galleryHasAddAsanas && $testHasAddAsanas) {
    addFinding($findings, 'warn', 'app/Http/Controllers/', null,
        'addAsanas() is duplicated in both GalleryController and TestController — see DEPLOYMENT_TODO.md item 3');
}

// ---------------------------------------------------------------------------
// Report
// ---------------------------------------------------------------------------
$errors = array_filter($findings, fn ($f) => $f['level'] === 'error');
$warnings = array_filter($findings, fn ($f) => $f['level'] === 'warn');

echo "== Yoga App Convention Lint ==\n\n";

if (empty($findings)) {
    echo "No convention violations found.\n";
    exit(0);
}

foreach (['error' => $errors, 'warn' => $warnings] as $level => $group) {
    foreach ($group as $f) {
        $tag = $level === 'error' ? '[ERROR]' : '[WARN] ';
        $location = $f['file'].($f['line'] ? ':'.$f['line'] : '');
        echo "{$tag} {$location} — {$f['message']}\n";
    }
}

echo "\n".count($errors).' error(s), '.count($warnings)." warning(s).\n";

exit(count($errors) > 0 ? 1 : 0);
