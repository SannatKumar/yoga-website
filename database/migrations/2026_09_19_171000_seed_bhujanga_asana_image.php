<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Data-only migration (no schema change): links the Bhujanga Asana (id 19) image.
     *
     * Follow-up correction: `2026_09_19_170000_seed_images_for_newly_photographed_asanas.php`
     * deliberately excluded `cuttedones/Bhujanga.png`, guessing from the still frame alone that
     * a hands-and-knees backbend with the hips off the ground wasn't Bhujanga Asana (Cobra Pose).
     * The project owner confirmed this is their own practiced variation of the pose, so it's the
     * correct image after all — added here instead of editing the already-run migration.
     */
    public function up(): void
    {
        DB::table('images')->insert([
            'asanas_id' => 19,
            'image_path' => 'images/yogasana_pictures/bhujanga_asana_front_side.png',
            'image_name' => 'Bhujanga Asana Front View',
            'alt_text' => 'Person in Bhujanga Asana (Cobra Pose), chest lifted and gaze upward',
            'is_primary' => true,
            'sort_order' => 1,
            'mime_type' => 'image/png',
            'file_size' => 841008,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('images')->where('asanas_id', 19)->delete();
    }
};
