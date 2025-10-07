# 🧘‍♀️ Creating the `asanas` Table using Laravel 12 Migration

This guide explains how to create a **new database table** in **Laravel 12** using **migrations**.  
We’ll walk through creating a migration, defining the table schema, and running the migration.

---

## 📘 Description

Laravel migrations allow developers to manage and version-control database changes easily.  
Each migration file contains two methods:

- **up()** → Defines the structure of the new table or changes to apply.
- **down()** → Reverses those changes if you roll back the migration.

In this example, we’ll create an **`asanas`** table for storing yoga poses.

---

## ⚙️ Step 1: Create a Migration File

Run the following Artisan command in your terminal:

```bash
php artisan make:migration create_asanas_table
```

This creates a new migration file in the `database/migrations/` folder, such as:

```
database/migrations/2025_10_07_123456_create_asanas_table.php
```

---

## 🧱 Step 2: Define the Table Schema

Open the generated migration file and edit it as follows:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asanas', function (Blueprint $table) {
            $table->id(); // Primary key (auto-increment)
            $table->string('asana_name', 100);
            $table->string('asana_description', 100)->nullable();
            $table->integer('source_id')->nullable();
            $table->integer('steps_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('tag_id')->nullable();
            $table->integer('time_of_the_day_id')->nullable();
            $table->integer('reference_id')->nullable();
            $table->dateTime('created')->useCurrent(); // Default current datetime
            $table->dateTime('modified')->nullable()->useCurrentOnUpdate();
            $table->boolean('deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asanas');
    }
};
```

### 🔍 Table Overview

| Column Name          | Type          | Description |
|----------------------|---------------|--------------|
| id                   | INT (PK, AI)  | Unique identifier for each asana |
| asana_name           | VARCHAR(100)  | Name of the asana |
| asana_description    | VARCHAR(100)  | Short description of the asana |
| source_id            | INT           | Optional foreign key reference |
| steps_id             | INT           | Optional foreign key reference |
| category_id          | INT           | Optional foreign key reference |
| tag_id               | INT           | Optional foreign key reference |
| time_of_the_day_id   | INT           | Optional foreign key reference |
| reference_id         | INT           | Optional foreign key reference |
| created              | DATETIME      | Automatically set when created |
| modified             | DATETIME      | Automatically updated on change |
| deleted              | BOOLEAN       | Marks soft-deleted entries (0 = active) |

---

## 🚀 Step 3: Run the Migration

Once your schema is ready, apply it to the database:

```bash
php artisan migrate
```

You should see an output similar to:

```
Migrating: 2025_10_07_123456_create_asanas_table
Migrated:  2025_10_07_123456_create_asanas_table (30.21ms)
```

---

## 🧹 Step 4: Roll Back (Optional)

If you ever need to undo this migration, run:

```bash
php artisan migrate:rollback
```

This will remove the `asanas` table from the database.

---

## ✅ Summary

| Step | Command | Purpose |
|------|----------|----------|
| 1 | `php artisan make:migration create_asanas_table` | Create migration file |
| 2 | *(Edit file)* | Define the table structure |
| 3 | `php artisan migrate` | Apply migration to database |
| 4 | `php artisan migrate:rollback` | Revert the last migration |

---

## 💡 Notes

- Use `php artisan migrate:fresh` to rebuild the entire database from scratch.
- Migrations should be committed to version control (`git`) so your team can stay in sync.
- You can create **seeders** to populate the table with initial data — see `AsanasTableSeeder` example for reference.

---
