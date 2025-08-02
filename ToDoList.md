# 🚀 Yoga Practice Website Launch Plan (Target: August)

## 📅 WEEK 1 (Aug 1–7) – Content Completion & Translations
- [ ] Finalize homepage content (remove image, add intro block)
- [ ] Write Guidebook/Steps page with `<x-step-card>` component
- [ ] Finalize "Why Yoga", "Vision", and "About" content
- [ ] Write English translation file (`lang/en/messages.php`)
- [ ] Add placeholders for Hindi and Sanskrit translations
- [ ] Replace all hardcoded texts with `__('messages.key')`
- [ ] Add SEO metadata (title, meta description, OG)

---

## 🎨 WEEK 2 (Aug 8–14) – Components + UI Cleanup
- [ ] Create `<x-step-card>` Blade component
- [ ] Create `<x-quote-card>` component for references
- [ ] Create `<x-info-box>` for tips/notes/contraindications
- [ ] Create `<x-section-header>` for titles (consistent design)
- [ ] Replace legacy HTML blocks with Blade components
- [ ] Standardize spacing and margin across sections

---

## 🌐 WEEK 3 (Aug 15–21) – Localization & Dynamic Logic
- [ ] Implement language switcher in navbar
- [ ] Apply `app()->getLocale()` to all route links
- [ ] Translate all content using translation files
- [ ] Support fallback translations
- [ ] Add dynamic content rendering (looping through DB-based sections if needed)

---

## ✅ WEEK 4 (Aug 22–31) – Testing, Deployment, Polish
- [ ] Test on desktop / tablet / mobile
- [ ] Check route availability and responsiveness
- [ ] Test translations across languages
- [ ] Add favicon and manifest
- [ ] Connect Google Analytics or Plausible
- [ ] Run `php artisan config:cache`, `route:cache`
- [ ] Setup hosting + deployment
