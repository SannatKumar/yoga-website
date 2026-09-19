# Frontend Conventions

Written 2026-09-19. This is server-rendered Laravel Blade — no SPA framework, no client-side
router. Vite + Tailwind v4 (`@tailwindcss/vite` plugin, no separate `tailwind.config.js` — Tailwind
v4 configures via CSS) build `resources/css/app.css` and `resources/js/app.js`. There is very
little custom JavaScript in this project; almost all interactivity (popups, filters) is done with
plain CSS (`:target`) or server-side filtering via query strings, not client-side JS.

## Page structure

- Every page view starts with `@extends('layouts.app')` and wraps its content in
  `@section('content') ... @endsection`.
- `resources/views/layouts/app.blade.php` + `header.blade.php` + `footer.blade.php` are the only
  layout files — don't create a second layout unless a page genuinely can't fit this one (none do
  currently).
- The `<x-page-header>` component (`resources/views/components/page-header.blade.php`) is the
  standard page banner — every top-level page opens with one, passing an `image_path` (an SVG
  under `public/lotus-images/`) and translated `text`. Use it for any new page rather than a
  hand-rolled heading.

## Two coexisting layout styles — pick based on page type, not preference

This project has two genuinely different CSS/markup approaches, split cleanly by what kind of
page it is. **Don't mix them within one page.**

**1. Tailwind utility-class grid pages** — for listing/gallery-style pages:
`gallery.blade.php`, `sukhsma-vyayama.blade.php`, `sthula-vyayama.blade.php`,
`tibetan-rites.blade.php`. Cards, filters, and search boxes are built entirely from Tailwind
utility classes (`grid grid-cols-*`, `bg-white rounded-xl shadow-md`, `px-4 py-2`, etc.) with no
`<style>` block. **Use this style for any new listing/grid page** — copy the structure of
`tibetan-rites.blade.php` (the newest, cleanest example) rather than starting from scratch.

**2. Hand-rolled `<style>` block pages** — for single-subject / detail-style pages:
`gallery-detail.blade.php`, `surya-namaskara.blade.php`, `show-asana.blade.php`,
`yoga-nidra.blade.php`. Markup is a sequence of numbered `<div class="part-N-div">` sections (a
project-wide pattern — see below), styled by a `<style>` block at the bottom of the same file,
plain CSS with descriptive kebab-case class names (`.asana-info`, `.meta-pill`, `.step-image-img`).
**Use this style for a new detail/single-purpose page.**

## The "part-N-div" section pattern

Several top-level pages (`show-asana.blade.php`, `gallery-detail.blade.php`, and others) lay out
their page as a fixed sequence of `<div class="part-one-div">`, `<div class="part-two-div">`, …
`<div class="part-nine-div">` sections, most left empty as placeholders for content that hasn't
been built yet, with HTML comments marking where each starts/ends (`<!--First Div starts -->` /
`<!--First Div Ends-->`). This is a scaffolding convention from early in the project — when adding
content to one of these pages, **fill in the existing empty `part-N-div` that best matches your
content's position** rather than adding new divs outside the sequence, unless every existing slot
is already used.

## Reusable Blade components

Small, prop-driven components live in `resources/views/components/` and are used with the
`<x-component-name>` tag, props declared via `@props([...])` at the top of the file with sane
defaults:
- `<x-page-header>` — page banner (see above).
- `<x-asana-step-card>` — the two-column "steps text + final-pose image" card used on the asana
  detail page. Takes `header`, `steps`, `description`, and (as of 2026-09-19)
  `image_url`/`image_header`/`image_alt` for the single final-pose photo — it used to take an
  `image_paths` array rendered as a 2×2 grid of placeholder images; that was replaced with one
  real photo per asana, filled with `object-fit: cover`, once real photos existed for more than a
  handful of asanas. If you're adding a new prop to an existing component, give it a sensible
  default in `@props([...])` so pages that don't pass it don't break.
- `<x-locale-switcher>` — language switcher, used once in the header layout.
- Components without an `x-` prefix in the directory name but still used as page fragments
  (`pose-steps.blade.php`, `philosophy-card.blade.php`, `guide-block.blade.php`) — included via
  `@include('components.name')` rather than the `<x-...>` tag in the places they're used. New
  reusable fragments should use `@props` + `<x-...>` (the newer, preferred style) unless they need
  to stay consistent with an existing `@include`-based caller.

## Translation strings

- All user-facing copy goes through `__('messages.key')`, keys defined in
  `resources/lang/en/messages.php` (and per-locale files alongside it). Keys are kebab-case
  matching the English phrase loosely (`'tibetan-rites-desc'`, `'search-placeholder'`). Always
  provide a literal-string fallback with `??` when a key might not exist yet in every locale file:
  `{{ __('messages.some-key') ?? 'Fallback text' }}` — this pattern is used throughout and should
  continue, since not every locale file is guaranteed to have every key.

## Fallback images

- **Use `/lotus-images/blank_image.png` as the generic "no image yet" placeholder** — this is
  what `GalleryController::index()` and (as of 2026-09-19) `gallery-detail.blade.php` /
  `asana-step-card.blade.php` fall back to when an asana has no `images` row.
  **Never fall back to a real, named asana's photo file as a generic placeholder** — an earlier
  version of `gallery-detail.blade.php` defaulted to `/images/yogasana_pictures/virasana.jpeg`
  for *any* asana with no image, which would silently show a real Virasana photo on, say, a
  Halasana page that hadn't been given its own image yet. Fixed 2026-09-19; don't reintroduce a
  specific-pose image as a generic fallback anywhere else in the app.
