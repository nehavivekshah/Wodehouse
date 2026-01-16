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
        Schema::table('facility_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('id');
            // Optional: Add foreign key constraint if you want strict integrity
            // $table->foreign('parent_id')->references('id')->on('facility_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facility_categories', function (Blueprint $table) {
            $table->dropColumn('parent_id');
        });
    }
};
