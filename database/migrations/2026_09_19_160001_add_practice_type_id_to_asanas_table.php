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
        Schema::table('asanas', function (Blueprint $table) {
            $table->foreignId('practice_type_id')->nullable()->after('id')->constrained('practice_types');
        });

        // Every existing row is a regular asana (practice_type_id 1).
        DB::table('asanas')->update(['practice_type_id' => 1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asanas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('practice_type_id');
        });
    }
};
