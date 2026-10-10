<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('difficulty_levels', function (Blueprint $table) {
            $table->id();
            $table->string('level_name', 50);
            $table->integer('sort_order')->nullable();
            $table->timestamps();
        });

        DB::table('difficulty_levels')->insert([
            ['id' => 1, 'level_name' => 'Beginner', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'level_name' => 'Intermediate', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'level_name' => 'Advanced', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'level_name' => 'All Levels', 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('difficulty_levels');
    }
};
