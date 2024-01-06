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
        // Schema::create('orders', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained();
        //     $table->foreignId('payment_type_id')->constrained();
        //     $table->decimal('total_price', 12, 2, true);
        //     $table->string('delivery_address', 500);
        //     $table->decimal('delivery_price', 10, 2, true)->default(0);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('orders', function (Blueprint $table) {
        //     $table->dropForeign(['user_id']);
        //     $table->dropForeign(['payment_type_id']);
        // });

        // Schema::dropIfExists('orders');
    }
};
