<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_clients', function (Blueprint $table) {
            $table->bigIncrements('client_id')->unsigned();
            $table->string('client_name')->require;
            $table->string('client_address')->nullable();
            $table->string('client_zip')->nullable();
            $table->string('client_city')->nullable();
            $table->string('client_phonenumber')->unique()->require;
            $table->unsignedBigInteger('client_hair_type')->nullable();
            $table->unsignedBigInteger('client_scalp_type')->nullable();
            $table->timestamps();

            $table->foreign('client_hair_type')->references('hair_type_id')->on('tbl_client_hair_types');
            $table->foreign('client_scalp_type')->references('scalp_type_id')->on('tbl_client_scalps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_clients');
    }
}
