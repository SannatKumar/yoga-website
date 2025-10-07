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
        Schema::create('asanas', function (Blueprint $table) {
            $table->id();
            $table->string('asana_name', 100);
            $table->string('asana_description', 100)->nullable();
            $table->integer('source_id')->nullable();
            $table->integer('steps_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('tag_id')->nullable();
            $table->integer('time_of_the_day_id')->nullable();
            $table->integer('reference_id')->nullable();
            $table->dateTime('created')->useCurrent();
            $table->dateTime('modified')->useCurrentOnUpdate();
            $table->boolean('deleted')->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asanas');
    }
};
