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
        Schema::table('values', function (Blueprint $table) {
            $table->dropForeign(['option_id']);
        });

        Schema::drop('values');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('values', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->foreignId('option_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }
};
