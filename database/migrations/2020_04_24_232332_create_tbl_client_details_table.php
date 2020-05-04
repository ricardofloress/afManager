<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblClientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_client_details', function (Blueprint $table) {
            $table->bigIncrements('client_detail_id');
            $table->unsignedBigInteger('client_id')->require;
            $table->string('client_work_detail')->require;
            $table->timestamps();

            $table->foreign('client_id')->references('client_id')->on('tbl_clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_client_details');
    }
}
