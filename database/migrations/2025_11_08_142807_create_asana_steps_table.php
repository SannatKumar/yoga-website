<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asana_steps', function (Blueprint $table) {
            $table->id();
            $table->string('asana_steps', 100);
            $table->integer('steps_order_number')->nullable();
            $table->integer('asanas_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asana_steps');
    }
};
