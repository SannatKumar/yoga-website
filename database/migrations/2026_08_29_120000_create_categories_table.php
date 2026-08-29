<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name', 100);
            $table->string('category_description', 255)->nullable();
            $table->timestamps();
        });

        DB::table('categories')->insert([
            ['id' => 1, 'category_name' => 'Standing Asana', 'category_description' => 'Poses performed standing upright.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'category_name' => 'Sitting Asana', 'category_description' => 'Poses performed in a seated position.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'category_name' => 'Supine Asana', 'category_description' => 'Poses performed lying on the back.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'category_name' => 'Prone Asana', 'category_description' => 'Poses performed lying on the front.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'category_name' => 'Balancing Asana', 'category_description' => 'Poses that emphasize balance.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'category_name' => 'Inverted Asana', 'category_description' => 'Poses where the head is below the heart.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'category_name' => 'Twisting Asana', 'category_description' => 'Poses that involve a spinal twist.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};