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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('branch', 12)->default('1');
            $table->string('category', 50)->nullable();
            $table->string('name', 100);
            $table->string('slog', 100);
            $table->string('sku', 100);
            $table->string('cas_no')->nullable();
            $table->string('uom')->nullable();
            $table->string('synonym')->nullable();
            $table->string('related_products')->nullable();
            $table->string('purity')->nullable();
            $table->string('potency')->nullable();
            $table->string('impurity_type')->nullable();
            $table->string('molecular_name')->nullable();
            $table->string('molecular_weight')->nullable();
            $table->string('img', 100);
            $table->string('gallery', 500);
            $table->string('sdes', 500);
            $table->string('hsn_code')->nullable();
            $table->string('gst', 20)->nullable();
            $table->integer('featured')->default(0);
            $table->integer('new')->default(0);
            $table->string('file')->nullable();
            $table->string('tags', 300);
            $table->binary('des'); // blob
            $table->binary('ainfo'); // blob
            $table->string('stocks', 500);
            $table->string('review', 20);
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
