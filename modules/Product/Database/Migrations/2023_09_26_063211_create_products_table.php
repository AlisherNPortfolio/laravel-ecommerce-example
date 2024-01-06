<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug', 300)->unique();
            $table->string('sku');
            $table->decimal('price', 10);
            $table->decimal('discounted_price', 10)->default(0);
            $table->decimal('cost', 10)->default(0);
            $table->integer('quantity')->default(0);
            $table->boolean('track_quantity')->default(true);
            $table->boolean('sell_out_of_stock')->default(false);
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            //--------------------
            $table->tinyInteger('is_active')->default(1);
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('measure_type', 100)->default('dona');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
        });
        Schema::dropIfExists('products');
    }

    // Schema::create('products', function (Blueprint $table) {
    //     $table->id();
    //     $table->foreignId('category_id')->constrained();
    //     $table->string('name');
    //     $table->string('image', 300);
    //     $table->decimal('price', 12, 2, true);
    //     $table->decimal('old_price', 12, 2, true);
    //     $table->tinyInteger('stars')->default(0);
    //     $table->text('description');
    //     $table->text('features')->nullable();
    //     $table->tinyInteger('has_on_werehouse')->default(1);
    //     $table->integer('qty_on_werehouse')->default(1);
    //     $table->tinyInteger('is_active')->default(1);
    //     $table->string('type')->nullable()->comment('new, sale, featured');
    //     $table->string('meta_keywords')->nullable();
    //     $table->text('meta_description')->nullable();
    //     $table->string('measure_type', 100)->default('dona');
    //     $table->timestamps();
    // });
};
