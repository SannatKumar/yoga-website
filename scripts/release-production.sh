#!/usr/bin/env bash
#
# Builds (first run) or updates the `production` branch from `master`.
#
#   master      = development: everything (docs, tests, tooling, notes).
#   production  = what the server runs: master minus every path in .production-exclude.
#
# Never commit to `production` by hand — always change master, then run this:
#
#   bash scripts/release-production.sh
#   git push origin production
#
# It works in a temporary git worktree, so your own working folder never leaves master.
# See docs/DEPLOYMENT_PLAN.md, "Branches".

set -euo pipefail

die() { echo "release-production: $*" >&2; exit 1; }

cd "$(git rev-parse --show-toplevel)"

[ "$(git branch --show-current)" = "master" ] || die "switch to master first"
[ -z "$(git status --porcelain)" ] || die "working tree not clean — commit or stash first"
[ -f .production-exclude ] || die ".production-exclude not found"

# Read the exclude list (strip comments and blank lines).
mapfile -t paths < <(sed -e 's/#.*//' -e 's/[[:space:]]*$//' .production-exclude | grep -v '^$')
[ "${#paths[@]}" -gt 0 ] || die ".production-exclude is empty"

# Safety: an excluded image must not be referenced by code on master anymore. (Database image
# paths can't be checked from here — `images.image_path` only points at used files as of 2026-10-10.)
for p in "${paths[@]}"; do
    case "$p" in
        public/*)
            name="$(basename "$p")"
            if git grep -q -F "$name" master -- app resources routes config; then
                die "'$p' is listed in .production-exclude but code references '$name' — remove it from the list"
            fi
            ;;
    esac
done

sha="$(git rev-parse --short master)"
wt="$(git rev-parse --git-dir)/release-worktree"
cleanup() { git worktree remove --force "$wt" >/dev/null 2>&1 || true; }
cleanup
trap cleanup EXIT

if git show-ref --verify --quiet refs/heads/production; then
    git worktree add -q "$wt" production
    # Files deleted on production but edited on master show up as modify/delete conflicts;
    # the `git rm` below resolves exactly those, so a non-zero exit here is expected.
    git -C "$wt" merge --no-ff --no-commit master >/dev/null 2>&1 || true
    message="Release master @ $sha"
else
    git worktree add -q -b production "$wt" master
    message="Create production branch from master @ $sha"
fi

git -C "$wt" rm -r -q -f --ignore-unmatch -- "${paths[@]}"

if [ -n "$(git -C "$wt" diff --name-only --diff-filter=U)" ]; then
    git -C "$wt" merge --abort >/dev/null 2>&1 || true
    die "unexpected merge conflicts (was production edited by hand?):
$(git -C "$wt" diff --name-only --diff-filter=U)"
fi

for required in artisan composer.json composer.lock package.json public/index.php .env.production.example; do
    [ -e "$wt/$required" ] || die "'$required' would be missing from production — check .production-exclude"
done

if ! git -C "$wt" rev-parse -q --verify MERGE_HEAD >/dev/null \
    && git -C "$wt" diff --cached --quiet; then
    echo "production is already up to date with master @ $sha"
    exit 0
fi

git -C "$wt" commit -q -m "$message"

echo "production updated: $(git log -1 --format='%h %s' production)"
echo "files on production: $(git ls-tree -r --name-only production | wc -l) (master: $(git ls-tree -r --name-only master | wc -l))"
echo
echo "Next: git push origin production   — then on the server: see 'Updating the site later' in docs/DEPLOYMENT_PLAN.md"
