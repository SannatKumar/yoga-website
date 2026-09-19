<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Lookup table distinguishing what kind of practice a row in `asanas`
     * is. Sukshma Vyayama, Sthula Vyayama, and Tibetan Rites practices are
     * stored in the same `asanas` table as regular asanas (same shape:
     * name + ordered steps + benefits + contraindications), distinguished
     * only by this type. Surya Namaskara is NOT a practice_type here — it's
     * a sequence of other practices, modeled separately (see
     * create_surya_namaskara_tables migration).
     */
    public function up(): void
    {
        Schema::create('practice_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_name', 100);
            $table->string('type_description', 255)->nullable();
            $table->timestamps();
        });

        DB::table('practice_types')->insert([
            ['id' => 1, 'type_name' => 'Asana', 'type_description' => 'A classical yoga posture.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'type_name' => 'Sukshma Vyayama', 'type_description' => 'Subtle/joint-loosening exercises (Pawanamuktasana series, Shakti Vikasaka group).', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'type_name' => 'Sthula Vyayama', 'type_description' => 'Gross/vigorous loosening exercises requiring more physical effort than Sukshma Vyayama.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'type_name' => 'Tibetan Rite', 'type_description' => 'One of the five Tibetan Rites.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practice_types');
    }
};
