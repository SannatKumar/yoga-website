<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->id();
            $table->string('source_name', 150);
            $table->string('source_url', 255)->nullable();
            $table->string('source_description', 255)->nullable();
            $table->timestamps();
        });

        DB::table('sources')->insert([
            ['id' => 1, 'source_name' => 'Traditional / General Practice', 'source_url' => null, 'source_description' => 'Default placeholder source for content not yet attributed.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sources');
    }
};
