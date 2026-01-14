<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('facility_availabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facility_id');
            $table->tinyInteger('day_of_week')->comment('0=Sunday, 1=Monday, ...');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('slot_duration')->default(60);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_availabilities');
    }
};
