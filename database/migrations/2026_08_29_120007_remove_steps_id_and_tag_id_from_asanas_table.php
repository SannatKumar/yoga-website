<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * `steps_id` is superseded by `asana_steps.asanas_id` (one asana has
     * many steps). `tag_id` is superseded by the `asana_tag` pivot table
     * (one asana can have many tags).
     */
    public function up(): void
    {
        Schema::table('asanas', function (Blueprint $table) {
            $table->dropColumn(['steps_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asanas', function (Blueprint $table) {
            $table->integer('steps_id')->nullable();
            $table->integer('tag_id')->nullable();
        });
    }
};