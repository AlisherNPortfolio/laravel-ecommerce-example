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
        Schema::create('payment_type_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_type_id')->constrained()->onDelete('cascade');
            $table->string('key', 100);
            $table->string('value', 255);
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
        Schema::table('payment_type_settings', function (Blueprint $table) {
            $table->dropForeign(['payment_type_id']);
        });
        Schema::dropIfExists('payment_type_settings');
    }
};
