<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * The original migration set `asana_steps` to varchar(100) — fine for
     * short fragments but too small for real practice-step sentences (the
     * 2026-09-19 content batch hit "Data too long" on several rows).
     * Matches the 500-char width already used for asana_benefits.benefit
     * and asana_contraindications.contraindication.
     */
    public function up(): void
    {
        Schema::table('asana_steps', function (Blueprint $table) {
            $table->string('asana_steps', 500)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asana_steps', function (Blueprint $table) {
            $table->string('asana_steps', 100)->change();
        });
    }
};
