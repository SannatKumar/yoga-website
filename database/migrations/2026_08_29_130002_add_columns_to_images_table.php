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
     * The original `create_images_table` migration only created `id` and
     * timestamps — no actual columns. This adds the real ones instead of
     * editing that migration directly, since it has already run (editing
     * an already-applied migration would leave `migrate:status` lying
     * about what's actually in the database).
     *
     * Files themselves stay on disk (under `public/images/...`); this
     * table only stores the path/name/metadata pointing at them.
     */
    public function up(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->foreignId('asanas_id')->nullable()->after('id')->constrained('asanas')->cascadeOnDelete();
            $table->string('image_path', 255)->after('asanas_id');
            $table->string('image_name', 150)->after('image_path');
            $table->string('alt_text', 255)->nullable()->after('image_name');
            $table->boolean('is_primary')->default(false)->after('alt_text');
            $table->integer('sort_order')->nullable()->after('is_primary');
            $table->string('mime_type', 50)->nullable()->after('sort_order');
            $table->unsignedInteger('file_size')->nullable()->after('mime_type');
        });

        // Dummy data pointing at real files already in public/images.
        DB::table('images')->insert([
            [
                'asanas_id' => 1,
                'image_path' => 'images/tadasana.jpeg',
                'image_name' => 'Tadasana Front View',
                'alt_text' => 'Person standing in Tadasana (Mountain Pose)',
                'is_primary' => true,
                'sort_order' => 1,
                'mime_type' => 'image/jpeg',
                'file_size' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asanas_id' => 2,
                'image_path' => 'images/duipadahastasana.jpeg',
                'image_name' => 'Padahastasana Front View',
                'alt_text' => 'Person bending forward in Padahastasana (Hand to Foot Pose)',
                'is_primary' => true,
                'sort_order' => 1,
                'mime_type' => 'image/jpeg',
                'file_size' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asanas_id' => 8,
                'image_path' => 'images/yogasana_pictures/vajrasana_front_side.jpg',
                'image_name' => 'Vajrasana Front View',
                'alt_text' => 'Person kneeling in Vajrasana (Thunderbolt Pose)',
                'is_primary' => true,
                'sort_order' => 1,
                'mime_type' => 'image/jpeg',
                'file_size' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropConstrainedForeignId('asanas_id');
            $table->dropColumn([
                'image_path',
                'image_name',
                'alt_text',
                'is_primary',
                'sort_order',
                'mime_type',
                'file_size',
            ]);
        });
    }
};
