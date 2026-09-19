# CSS Conventions

Written 2026-09-19. Two deliberate, coexisting approaches — confirmed by checking every top-level
view: listing/grid pages carry zero `<style>` blocks and rely entirely on Tailwind utility
classes; detail/single-purpose pages carry zero Tailwind utility classes and rely entirely on a
hand-rolled `<style>` block in the same file. This split is intentional (see
`CONVENTIONS_FRONTEND.md` for *when* to use which); this document covers *how* each is written.

## Tailwind (v4, via `@tailwindcss/vite`, no `tailwind.config.js`)

Used on: `gallery.blade.php`, `sukhsma-vyayama.blade.php`, `sthula-vyayama.blade.php`,
`tibetan-rites.blade.php`, and parts of `welcome.blade.php`.

- Plain utility classes inline in the markup — `class="grid grid-cols-1 sm:grid-cols-2
  lg:grid-cols-3 gap-6"`, `class="bg-white rounded-xl shadow-md p-4"`. No `@apply`, no custom
  Tailwind components layer, no design-token abstraction — utilities are used directly every time,
  even when the same combination repeats across cards. This keeps every page self-contained (copy
  a card's classes to change just that card) at the cost of some repetition — accepted trade-off
  in this codebase, not an oversight.
- Responsive breakpoints follow Tailwind's defaults (`sm:`, `md:`, `lg:`) directly — no custom
  breakpoint scale defined.
- No dark mode classes anywhere — the site is light-theme only, don't add `dark:` variants without
  a broader decision to support it.

## Hand-rolled plain CSS

Used on: `gallery-detail.blade.php`, `surya-namaskara.blade.php`, `show-asana.blade.php`,
`yoga-nidra.blade.php`, and the two reusable components `asana-step-card.blade.php` /
`page-header.blade.php`.

- **`<style>` block at the very bottom of the same `.blade.php` file**, after `@endsection` — no
  separate `.css` file per page, no `<style>` in the `<head>`. Keep new detail-style pages
  self-contained the same way; a page's styling should be readable in the same file as its markup.
- **Class names**: kebab-case, descriptive of the *element's role on this page*, not a reusable
  design-system token — `.asana-info`, `.meta-pill`, `.tag-pill`, `.step-image-img`,
  `.images-and-desc`. Classes are scoped by convention (each page/component uses its own class
  names) rather than by any CSS tooling — there is no CSS Modules/scoped-style mechanism, so a
  generic class name (`.card`, `.title`) reused across two different plain-CSS files *will*
  collide if both are ever rendered on the same request. This hasn't caused a bug yet because
  each of these pages is self-contained, but keep new class names reasonably specific
  (`.asana-thumb` rather than `.thumb`) to avoid it becoming one.
- **Color palette**, reused consistently across these pages: green `#25c55d` / `#e6f7ed` for
  positive/benefits content and card accents, red `#e74c3c` / `#fff3f3` for
  contraindications/warnings, blue `#3498db` / `#eff6ff` for neutral metadata (tags, "at a
  glance" pills). Reuse these exact values for any new info-block/pill on a plain-CSS page rather
  than picking new colors — see `.asana-info.benefits`, `.asana-info.contraindications`,
  `.asana-info.meta`/`.asana-info.tags` in `gallery-detail.blade.php` for the reference
  implementation.
- **Card/pill shape language**: `border-radius: 12px` for content blocks, `border-radius: 20px`
  for small pill badges (`.meta-pill`, `.tag-pill`), a colored `1px solid` border matching the
  block's semantic color rather than a shadow. Match this rather than introducing box-shadows on
  new plain-CSS blocks.
- **Responsive handling on plain-CSS pages** is done with explicit `@media` breakpoints mirroring
  Bootstrap's scale (`575.98px`, `767.98px`, `991.98px`, `1199.98px`) even though Bootstrap itself
  isn't used — this is a carried-over convention from early in the project (visible in
  `show-asana.blade.php`, `gallery-detail.blade.php`). Match these exact breakpoint values for
  consistency rather than introducing a different scale on a new page.
- **Images**: `object-fit: cover` is the standard for any photo that needs to fill a fixed-size
  or fixed-aspect-ratio box without distortion (`.asana-thumb`, `.step-image-img`,
  `.fixed-size`) — use it by default for any new asana photo placement rather than `contain` or a
  plain `width`/`height` with no `object-fit`, which was the source of the two-lotus-image overlap
  bug fixed earlier in the project.

## What NOT to do

- Don't add Tailwind utility classes to a page that already has a `<style>` block, or vice versa
  — pick one approach for the whole page based on its type (see `CONVENTIONS_FRONTEND.md`).
- Don't introduce a global stylesheet of shared component classes shared between the two systems
  — if a plain-CSS page and a Tailwind page need visually similar cards, it's fine for their
  implementations to differ; forcing a shared abstraction across the two systems isn't worth the
  coupling given how cleanly separated they are today.
