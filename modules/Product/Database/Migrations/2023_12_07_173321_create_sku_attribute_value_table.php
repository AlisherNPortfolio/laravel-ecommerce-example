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
        Schema::create('sku_attribute_value', function (Blueprint $table) {
            $table->foreignId('sku_id')->constrained()->cascadeOnDelete();
            $table->foreignId('attribute_value_id')->constrained()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sku_attribute_table', function (Blueprint $table) {
            $table->dropForeign(['sku_id']);
            $table->dropForeign(['attribute_value_id']);
        });

        Schema::dropIfExists('sku_attribute_value');
    }
};
