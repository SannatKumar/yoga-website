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
     * One asana has many benefits, same shape as `asana_steps` — a single
     * column on `asanas` could never have held this.
     */
    public function up(): void
    {
        Schema::create('asana_benefits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asanas_id')->constrained('asanas')->cascadeOnDelete();
            $table->string('benefit', 500);
            $table->integer('sort_order')->nullable();
            $table->timestamps();
        });

        // Dummy data for two real asanas already in the table (Tadasana id 1, Padahastasana id 2).
        DB::table('asana_benefits')->insert([
            ['asanas_id' => 1, 'benefit' => 'Improves posture and body alignment.', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['asanas_id' => 1, 'benefit' => 'Strengthens thighs, knees, and ankles.', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['asanas_id' => 1, 'benefit' => 'Improves balance and body awareness.', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['asanas_id' => 2, 'benefit' => 'Stretches the hamstrings and calves.', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['asanas_id' => 2, 'benefit' => 'Stimulates the abdominal organs and improves digestion.', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['asanas_id' => 2, 'benefit' => 'Calms the mind and relieves mild stress.', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asana_benefits');
    }
};
