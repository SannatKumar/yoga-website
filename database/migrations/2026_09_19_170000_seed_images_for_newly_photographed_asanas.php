<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Data-only migration (no schema change): links real photos to the 13 asanas that
     * had no image row yet. Sources:
     * - D:\Yoga_certificates\YogaMaterials\Haukkaniemi_yoga_pose_pictures (already copied into
     *   public/images/yogasana_pictures by a previous session) — covers Vrikshasana,
     *   Trikonasanaa, Bhadrasana, Uttana Mandukasana, Manduka Asana, Gomukhasana,
     *   Yoga Mudrasana, Padmasana.
     * - Existing top-level public/images/*.jpeg files that were on disk but never linked —
     *   Halasana, Sarvanga Asana, Vipareeta Karani.
     * - C:\Users\chitr\OneDrive\Pictures\EditedOnes\cuttedones, copied in after visually
     *   verifying each pose against its filename — Simha Garjasana, Vakrasana.
     *
     * Deliberately NOT included, after visual inspection ruled them out:
     * - cuttedones/Bhujanga.png (hands-and-knees stretch, not Bhujanga Asana/Cobra)
     * - cuttedones/HalasanaProper.jpeg (a prone backbend holding the feet, not Halasana)
     * - cuttedones/ArdhaMatsyendraAsana(Side).jpeg (no matching asana row exists yet)
     * - D:\...\Forest_August_Suryanamaskara — generic camera filenames (P1010xxx.JPG/MP4);
     *   most held frames are indistinguishable repeats of the same standing ready pose, not
     *   reliably attributable to a specific step (Pranamasana vs Hasta Uttanasana vs Ashwa
     *   Sanchalanasana vs Parvatasana vs Ashtanga Pranama) without a dedicated frame-by-frame
     *   pass. Left for a future session rather than guessed.
     * - public/images/virasana.jpeg — no "Virasana" asana row exists in the table.
     */
    public function up(): void
    {
        $now = now();

        $rows = [
            // Vrikshasana (id 6) — Tree Pose
            [6, 'yogasana_pictures/vrikshasana_front_side_left_leg_up.jpeg', 'Vrikshasana Front View', 'Person balancing in Vrikshasana (Tree Pose), left leg raised', true, 1, 1258920],
            [6, 'yogasana_pictures/vrikshasana_front_side_right_leg_up.jpeg', 'Vrikshasana Front View (Right Leg)', 'Person balancing in Vrikshasana (Tree Pose), right leg raised', false, 2, 1036528],

            // Trikonasanaa (id 5) — Triangle Pose
            [5, 'yogasana_pictures/trikonasana_front_side_right_tilt.jpeg', 'Trikonasana Front View (Right Tilt)', 'Person in Trikonasana (Triangle Pose), tilting to the right', true, 1, 1252690],
            [5, 'yogasana_pictures/trikonasana_front_side_left_tilt.jpeg', 'Trikonasana Front View (Left Tilt)', 'Person in Trikonasana (Triangle Pose), tilting to the left', false, 2, 1164079],
            [5, 'yogasana_pictures/trikonanasana_front_side_left_tilt_second.jpeg', 'Trikonasana Front View (Left Tilt, Alternate)', 'Person in Trikonasana (Triangle Pose), tilting to the left, second angle', false, 3, 1196166],

            // Bhadrasana (id 9) — Gracious Pose
            [9, 'yogasana_pictures/bhadrasana_front_side.jpeg', 'Bhadrasana Front View', 'Person seated cross-legged in Bhadrasana (Gracious Pose)', true, 1, 1032498],
            [9, 'yogasana_pictures/bhadrasana_back_side.jpeg', 'Bhadrasana Back View', 'Person seated in Bhadrasana (Gracious Pose), viewed from behind', false, 2, 1317941],
            [9, 'yogasana_pictures/bhadrasana_left_side.jpeg', 'Bhadrasana Left Side View', 'Person seated in Bhadrasana (Gracious Pose), left profile', false, 3, 1153472],
            [9, 'yogasana_pictures/bhadrasana_right_side.jpeg', 'Bhadrasana Right Side View', 'Person seated in Bhadrasana (Gracious Pose), right profile', false, 4, 1065114],

            // Uttana Mandukasana (id 10) — Stretching Frog Pose
            [10, 'yogasana_pictures/uttanamandukasana_front_side.jpeg', 'Uttana Mandukasana Front View', 'Person seated in Uttana Mandukasana (Stretching Frog Pose), arms raised', true, 1, 1103084],
            [10, 'yogasana_pictures/uttanamandukasana_front_side_second.jpeg', 'Uttana Mandukasana Front View (Alternate)', 'Person seated in Uttana Mandukasana (Stretching Frog Pose), second angle', false, 2, 1136116],
            [10, 'yogasana_pictures/uttanamandukasana_back_side_left_hand_top.jpeg', 'Uttana Mandukasana Back View (Left Hand Top)', 'Person in Uttana Mandukasana (Stretching Frog Pose), back view, left hand on top', false, 3, 1231771],
            [10, 'yogasana_pictures/uttanamandukasana_back_side_right_hand_top.jpeg', 'Uttana Mandukasana Back View (Right Hand Top)', 'Person in Uttana Mandukasana (Stretching Frog Pose), back view, right hand on top', false, 4, 1132616],

            // Manduka Asana (id 11) — Frog Pose
            [11, 'yogasana_pictures/mandukasana_front_side.jpeg', 'Manduka Asana Front View', 'Person folded forward in Manduka Asana (Frog Pose)', true, 1, 1461270],
            [11, 'yogasana_pictures/mandukasana_left_side.jpeg', 'Manduka Asana Left Side View', 'Person in Manduka Asana (Frog Pose), left profile', false, 2, 1339331],
            [11, 'yogasana_pictures/mandukasana_right_side.jpeg', 'Manduka Asana Right Side View', 'Person in Manduka Asana (Frog Pose), right profile', false, 3, 1250163],
            [11, 'yogasana_pictures/mandukasana_back_side.jpeg', 'Manduka Asana Back View', 'Person in Manduka Asana (Frog Pose), viewed from behind', false, 4, 1320905],

            // Gomukhasana (id 12) — Cow Face Pose
            [12, 'yogasana_pictures/gomukhasana_front_side_left_hand_and_left_leg_on_top.jpeg', 'Gomukhasana Front View (Left Hand & Leg on Top)', 'Person seated in Gomukhasana (Cow Face Pose), left hand and leg on top', true, 1, 1107991],
            [12, 'yogasana_pictures/gomukhasana_front_side_right_hand_and_right_leg_on_top.jpeg', 'Gomukhasana Front View (Right Hand & Leg on Top)', 'Person seated in Gomukhasana (Cow Face Pose), right hand and leg on top', false, 2, 1067448],
            [12, 'yogasana_pictures/gomukhasana_back_side_left_hand_and_left_leg_on_top.jpeg', 'Gomukhasana Back View (Left Hand & Leg on Top)', 'Person in Gomukhasana (Cow Face Pose), back view, left hand and leg on top', false, 3, 1153681],
            [12, 'yogasana_pictures/gomukhasana_back_side_right_hand_and_right_leg_on_top.jpeg', 'Gomukhasana Back View (Right Hand & Leg on Top)', 'Person in Gomukhasana (Cow Face Pose), back view, right hand and leg on top', false, 4, 1052848],

            // Yoga Mudrasana (id 18) — Yoga Seal Pose
            [18, 'yogasana_pictures/yogamudrasana_front_side.jpeg', 'Yoga Mudrasana Front View', 'Person seated and folded forward in Yoga Mudrasana (Yoga Seal Pose), arms behind the back', true, 1, 1448659],
            [18, 'yogasana_pictures/yogramudrasana_left_side.jpeg', 'Yoga Mudrasana Left Side View', 'Person in Yoga Mudrasana (Yoga Seal Pose), left profile', false, 2, 1223096],
            [18, 'yogasana_pictures/yogamudrasana_right_side.jpeg', 'Yoga Mudrasana Right Side View', 'Person in Yoga Mudrasana (Yoga Seal Pose), right profile', false, 3, 1137345],

            // Padmasana (id 34) — Lotus Pose
            [34, 'yogasana_pictures/padmasana_front_side.jpg', 'Padmasana Front View', 'Person seated in full Padmasana (Lotus Pose)', true, 1, 2055515],

            // Halasana (id 25) — Plow Pose
            [25, 'Halasana.jpeg', 'Halasana Front View', 'Person in Halasana (Plow Pose), legs extended over the head', true, 1, 187370],

            // Sarvanga Asana (id 24) — Shoulder Stand Pose
            [24, 'Sarvangasana.jpeg', 'Sarvanga Asana Front View', 'Person in Sarvanga Asana (Shoulder Stand Pose)', true, 1, 125813],

            // Vipareeta Karani (id 26) — Legs-Up Inverted Pose
            [26, 'Vipareetakarani.jpeg', 'Vipareeta Karani Front View', 'Person in Vipareeta Karani (Legs-Up Inverted Pose)', true, 1, 214416],

            // Simha Garjasana (id 17) — Roaring Lion Pose
            [17, 'yogasana_pictures/simha_garjasana_front_side.png', 'Simha Garjasana Front View', 'Person in Simha Garjasana (Roaring Lion Pose), head tilted back', true, 1, 800143],

            // Vakrasana (id 16) — Half Spinal Twist Pose
            [16, 'yogasana_pictures/vakrasana_right_twist.png', 'Vakrasana Front View (Right Twist)', 'Person in Vakrasana (Half Spinal Twist Pose), twisting to the right', true, 1, 802321],
            [16, 'yogasana_pictures/vakrasana_left_twist.png', 'Vakrasana Front View (Left Twist)', 'Person in Vakrasana (Half Spinal Twist Pose), twisting to the left', false, 2, 680001],
        ];

        DB::table('images')->insert(array_map(function ($row) use ($now) {
            [$asanasId, $path, $name, $alt, $isPrimary, $sortOrder, $fileSize] = $row;
            $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $mimeType = $extension === 'png' ? 'image/png' : 'image/jpeg';

            return [
                'asanas_id' => $asanasId,
                'image_path' => 'images/' . $path,
                'image_name' => $name,
                'alt_text' => $alt,
                'is_primary' => $isPrimary,
                'sort_order' => $sortOrder,
                'mime_type' => $mimeType,
                'file_size' => $fileSize,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $rows));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('images')->whereIn('asanas_id', [5, 6, 9, 10, 11, 12, 16, 17, 18, 24, 25, 26, 34])->delete();
    }
};
