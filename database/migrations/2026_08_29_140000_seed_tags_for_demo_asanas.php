<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Data-only migration (no schema change): seeds a few `tags` rows and
     * attaches them to Tadasana (asana id 1) and Padahastasana (id 2) via
     * `asana_tag`, so the gallery-detail page's new tags section has real
     * data to render for the two demo asanas.
     */
    public function up(): void
    {
        DB::table('tags')->insert([
            ['id' => 1, 'tag_name' => 'grounding', 'tag_description' => 'Poses that build a stable, rooted feeling.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'tag_name' => 'balance', 'tag_description' => 'Poses that train balance and coordination.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'tag_name' => 'posture', 'tag_description' => 'Poses that improve spinal alignment.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'tag_name' => 'flexibility', 'tag_description' => 'Poses that increase range of motion.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'tag_name' => 'digestion', 'tag_description' => 'Poses that stimulate the digestive organs.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'tag_name' => 'calming', 'tag_description' => 'Poses that soothe the nervous system.', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('asana_tag')->insert([
            ['asanas_id' => 1, 'tag_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['asanas_id' => 1, 'tag_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['asanas_id' => 1, 'tag_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['asanas_id' => 2, 'tag_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['asanas_id' => 2, 'tag_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['asanas_id' => 2, 'tag_id' => 6, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('asana_tag')->whereIn('asanas_id', [1, 2])->delete();
        DB::table('tags')->whereIn('id', [1, 2, 3, 4, 5, 6])->delete();
    }
};
