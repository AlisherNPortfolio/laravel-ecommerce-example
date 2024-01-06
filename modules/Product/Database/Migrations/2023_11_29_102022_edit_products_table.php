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
        Schema::table("products", function (Blueprint $table) {
            $table->dropColumn('track_quantity');
            $table->text('preview');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('has_warranty')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->integer('warranty_period')->default(0)->comment('2oy, 6oy, 12oy, 36oy kabi');
            $table->foreignId('tax_rule_id')->nullable()->constrained();
            $table->foreignId('shipping_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('track_quantity')->default(true);
            $table->dropColumn('preview');
            $table->dropColumn('is_featured');
            $table->dropColumn('is_new');
            $table->dropColumn('has_warranty');
            $table->dropColumn('is_popular');
            $table->dropColumn('warranty_period');
            $table->dropForeign(['tax_rule_id']);
            $table->dropForeign(['shipping_id']);
        });
    }
};
