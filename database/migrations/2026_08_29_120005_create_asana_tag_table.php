<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Pivot table: an asana can have many tags and a tag can belong to many
     * asanas (the sample gallery data shows 3+ tags per pose), so this
     * replaces the single `asanas.tag_id` column.
     */
    public function up(): void
    {
        Schema::create('asana_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asanas_id')->constrained('asanas')->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained('tags')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['asanas_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asana_tag');
    }
};
