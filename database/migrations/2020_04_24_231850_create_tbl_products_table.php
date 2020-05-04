<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_products', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->string('product_ean')->unique();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('manufacturer_id');
            $table->string('product_name')->require;
            $table->longText('product_long_description')->nullable();
            $table->longText('product_short_description')->nullable();
            $table->float('product_price')->require;
            $table->string('product_image')->nullable();
            $table->integer('product_size')->nullable();
            $table->integer('publication_status');
            $table->timestamps();

            $table->foreign('category_id')->references('category_id')->on('tbl_categories');
            $table->foreign('manufacturer_id')->references('manufacturer_id')->on('tbl_manufacturers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_products');
    }
}
