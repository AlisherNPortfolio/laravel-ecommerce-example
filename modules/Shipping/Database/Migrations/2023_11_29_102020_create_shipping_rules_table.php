<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_id')->constrained()->onDelete('cascade');
            $table->foreignId('district_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('price',8,2)->nullable()->default(0);
            $table->integer('shipping_hours')->default(1); // 1soat, 5soat
            $table->boolean('has_pickup_address')->default(false);
            $table->decimal('pickup_price',8,2)->nullable()->default(0);
            $table->string('pickup_phone', 20);
            $table->string('pickup_city');
            $table->string('pickup_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipping_rules', function (Blueprint $table) {
            $table->dropForeign(['shipping_id']);
            $table->dropForeign(['state_id']);
        });
        Schema::dropIfExists('shipping_rules');
    }
};
