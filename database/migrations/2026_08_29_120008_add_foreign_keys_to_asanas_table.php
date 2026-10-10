<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * The original `category_id`/`source_id`/`time_of_the_day_id`/
     * `reference_id` columns were plain signed integers with no real
     * foreign key. They're converted to unsigned big integers (to match
     * the referenced tables' `id` type) and given real FK constraints.
     */
    public function up(): void
    {
        Schema::table('asanas', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->change();
            $table->unsignedBigInteger('source_id')->nullable()->change();
            $table->unsignedBigInteger('time_of_the_day_id')->nullable()->change();
            $table->unsignedBigInteger('reference_id')->nullable()->change();
        });

        Schema::table('asanas', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('source_id')->references('id')->on('sources');
            $table->foreign('time_of_the_day_id')->references('id')->on('time_of_the_day');
            $table->foreign('reference_id')->references('id')->on('asana_references');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asanas', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['source_id']);
            $table->dropForeign(['time_of_the_day_id']);
            $table->dropForeign(['reference_id']);
        });
    }
};
