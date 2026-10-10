<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * PNG photos converted to JPEG by `scripts/compress-images.py --to-jpeg` (all fully opaque —
     * real photos saved as PNG, ~800 KB each → ~90 KB as JPEG).
     */
    private array $convertedPaths = [
        'images/yogasana_pictures/bhujanga_asana_front_side.png' => 'images/yogasana_pictures/bhujanga_asana_front_side.jpg',
        'images/yogasana_pictures/simha_garjasana_front_side.png' => 'images/yogasana_pictures/simha_garjasana_front_side.jpg',
        'images/yogasana_pictures/vakrasana_left_twist.png' => 'images/yogasana_pictures/vakrasana_left_twist.jpg',
        'images/yogasana_pictures/vakrasana_right_twist.png' => 'images/yogasana_pictures/vakrasana_right_twist.jpg',
    ];

    /**
     * `file_size` values before compression (ids 1-3 were never set), restored by down().
     */
    private array $previousFileSizes = [
        4 => 1258920, 5 => 1036528, 6 => 1252690, 7 => 1164079, 8 => 1196166, 9 => 1032498,
        10 => 1317941, 11 => 1153472, 12 => 1065114, 13 => 1103084, 14 => 1136116, 15 => 1231771,
        16 => 1132616, 17 => 1461270, 18 => 1339331, 19 => 1250163, 20 => 1320905, 21 => 1107991,
        22 => 1067448, 23 => 1153681, 24 => 1052848, 25 => 1448659, 26 => 1223096, 27 => 1137345,
        28 => 2055515, 29 => 187370, 30 => 125813, 31 => 214416, 32 => 800143, 33 => 802321,
        34 => 680001, 35 => 841008,
    ];

    /**
     * Data-only migration (no schema change): points the 4 converted asana photos at their new
     * `.jpg` files and refreshes `file_size` for every image row from the compressed file on disk.
     *
     * Images were compressed 2026-10-10 for the first deployment (phone photos 3024x4032 / ~1.2 MB
     * → max 1600px / ~300 KB). Rows whose file is missing on disk keep their current `file_size`.
     */
    public function up(): void
    {
        foreach ($this->convertedPaths as $oldPath => $newPath) {
            DB::table('images')->where('image_path', $oldPath)
                ->update(['image_path' => $newPath, 'mime_type' => 'image/jpeg', 'updated_at' => now()]);
        }

        foreach (DB::table('images')->get(['id', 'image_path']) as $image) {
            $file = public_path($image->image_path);
            if (is_file($file)) {
                DB::table('images')->where('id', $image->id)->update(['file_size' => filesize($file)]);
            }
        }
    }

    /**
     * Reverse the migrations. Restores the database values only — the original image files
     * themselves live in git history (before commit "Compress images").
     */
    public function down(): void
    {
        foreach ($this->convertedPaths as $oldPath => $newPath) {
            DB::table('images')->where('image_path', $newPath)
                ->update(['image_path' => $oldPath, 'mime_type' => 'image/png']);
        }

        DB::table('images')->whereIn('id', [1, 2, 3])->update(['file_size' => null]);
        foreach ($this->previousFileSizes as $id => $size) {
            DB::table('images')->where('id', $id)->update(['file_size' => $size]);
        }
    }
};
