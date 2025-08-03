
# Laravel Naming Conventions and Best Practices (Laravel 12+)

## ✅ Question 1: What is the best practice to name Blade files with two words?
**Best Practice:** Use **kebab-case**.

- ✅ `user-profile.blade.php`
- ✅ `admin-dashboard.blade.php`

**Why?**
- Matches Laravel’s default behavior (e.g. `auth/reset-password.blade.php`).
- Works well with `view('user-profile')`, `@include`, and `@extends`.

---

## ✅ Question 2: What is the best practice to name the routes with two words in `web.php`?
### 🔹 **URI Path:** Use **kebab-case**
```php
Route::get('/guru-stuti', [GuruStutiController::class, 'getGuruStuti']);
```
- ✅ `/guru-stuti`, `/user-profile`, `/blog-posts`

**Avoid:**
- ❌ `/guru_stuti`
- ❌ `/guruStuti`

### 🔹 **Route Name:** Use **dot notation + snake_case**
```php
Route::get('/guru-stuti', [GuruStutiController::class, 'getGuruStuti'])->name('guru.stuti');
```
- ✅ `'guru.stuti'`, `'user.profile'`, `'admin.dashboard'`

**Why?**
- Dot notation is clean for grouping (`admin.dashboard`, `user.profile`)
- snake_case is readable and follows Laravel community convention

---

## ✅ Additional Naming Conventions and Best Practices

### 🔹 Controller Method Names
- ✅ Use **camelCase**
```php
public function showUserProfile() {}
public function storeBlogPost() {}
```
- ❌ Avoid snake_case and PascalCase

### 🔹 Controller Names
- ✅ Use **PascalCase** and suffix with `Controller`
```php
UserProfileController
AdminDashboardController
```
- ❌ Avoid generic names like `PageController` unless necessary

### 🔹 Model Names
- ✅ Singular and **PascalCase**
```php
User, BlogPost, YogaClass
```
- ❌ Avoid plural model names

### 🔹 Migration File Names
- ✅ snake_case and describe the action
```bash
create_users_table.php
add_status_to_orders_table.php
```
- Laravel will auto-suffix with timestamps

### 🔹 Database Table Names
- ✅ Use **snake_case** and plural
```php
users, blog_posts, yoga_classes
```

### 🔹 Eloquent Relationships
- ✅ Use camelCase for method names
```php
public function blogPosts() { return $this->hasMany(BlogPost::class); }
public function userProfile() { return $this->hasOne(UserProfile::class); }
```

### 🔹 Route Group Prefixes
```php
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', ...)->name('dashboard'); // admin.dashboard
});
```

---

## 📢 Recent Trends and Findings (Laravel 10+ and 12)
- **Kebab-case** continues to be the standard for URL paths.
- **Dot notation** is favored for named routes (helps with grouping in IDEs).
- Laravel promotes **domain-driven structure**—e.g., feature-based folders instead of MVC separation.
- **Invokable Controllers** (`__invoke`) are gaining popularity for single-action endpoints.

**Resources:**
- [Laravel Official Docs](https://laravel.com/docs)
- [PSR-12: PHP Style Guide](https://www.php-fig.org/psr/psr-12/)
- [Laravel Route Naming Guide (Laracasts)](https://laracasts.com/discuss/channels/laravel/naming-convention-for-routes)
