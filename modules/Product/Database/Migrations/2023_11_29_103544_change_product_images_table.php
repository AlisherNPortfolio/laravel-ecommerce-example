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
        Schema::rename("product_images", "product_medias");
        Schema::table("product_medias", function (Blueprint $table) {
            $table->tinyInteger("file_type")->default(1)->after("order"); // 1 - image, 2 - video
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("product_medias", function (Blueprint $table) {
            $table->dropColumn("file_type");
        });

        Schema::rename("product_medias", "product_images");
    }
};
