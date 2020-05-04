<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblManufacturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_manufacturers', function (Blueprint $table) {
            $table->bigIncrements('manufacturer_id');
            $table->string('manufacturer_name')->unique()->require;
            $table->string('manufacturer_description')->nullable();
            $table->unsignedBigInteger('manufacturer_store')->nullable();
            $table->foreign('manufacturer_store')->references('store_id')->on('tbl_stores');
            $table->integer('publication_status');
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
        Schema::dropIfExists('tbl_manufacturers');
    }
}
