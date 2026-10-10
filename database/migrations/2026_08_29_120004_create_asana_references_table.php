<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Named `asana_references` rather than `references` because REFERENCES
     * is a reserved SQL keyword and would need quoting everywhere.
     */
    public function up(): void
    {
        Schema::create('asana_references', function (Blueprint $table) {
            $table->id();
            $table->string('reference_title', 150);
            $table->string('reference_url', 255)->nullable();
            $table->string('reference_description', 255)->nullable();
            $table->timestamps();
        });

        DB::table('asana_references')->insert([
            ['id' => 1, 'reference_title' => 'General Reference', 'reference_url' => null, 'reference_description' => 'Default placeholder reference for content not yet attributed.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asana_references');
    }
};
