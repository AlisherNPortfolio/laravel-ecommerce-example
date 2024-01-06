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
        // Schema::create('order_items', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('order_id')->constrained()->onDelete('CASCADE');
        //     $table->foreignId('product_id')->constrained();
        //     $table->foreignId('product_variation_id')->constrained();
        //     $table->integer('qty')->default(1);
        //     $table->decimal('price', 12, 2, true);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('order_items', function (Blueprint $table) {
        //     $table->dropForeign(['order_id']);
        //     $table->dropForeign(['product_id']);
        //     $table->dropForeign(['product_variation_id']);
        // });

        // Schema::dropIfExists('order_items');
    }
};
