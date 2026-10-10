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
        Schema::create('time_of_the_day', function (Blueprint $table) {
            $table->id();
            $table->string('time_name', 50);
            $table->string('time_description', 255)->nullable();
            $table->timestamps();
        });

        DB::table('time_of_the_day')->insert([
            ['id' => 1, 'time_name' => 'Morning', 'time_description' => 'Best practiced in the morning.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'time_name' => 'Afternoon', 'time_description' => 'Best practiced in the afternoon.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'time_name' => 'Evening', 'time_description' => 'Best practiced in the evening.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'time_name' => 'Anytime', 'time_description' => 'Can be practiced at any time of day.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_of_the_day');
    }
};
