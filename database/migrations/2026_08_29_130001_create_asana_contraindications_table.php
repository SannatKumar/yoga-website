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
     * Same shape as `asana_benefits` — an asana can have several
     * contraindications ("avoid if...").
     */
    public function up(): void
    {
        Schema::create('asana_contraindications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asanas_id')->constrained('asanas')->cascadeOnDelete();
            $table->string('contraindication', 500);
            $table->integer('sort_order')->nullable();
            $table->timestamps();
        });

        // Dummy data for the same two asanas (Tadasana id 1, Padahastasana id 2).
        DB::table('asana_contraindications')->insert([
            ['asanas_id' => 1, 'contraindication' => 'Low blood pressure.', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['asanas_id' => 1, 'contraindication' => 'Headache or insomnia.', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['asanas_id' => 2, 'contraindication' => 'Recent back or hamstring injury.', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['asanas_id' => 2, 'contraindication' => 'High blood pressure or vertigo.', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['asanas_id' => 2, 'contraindication' => 'Pregnancy.', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asana_contraindications');
    }
};
