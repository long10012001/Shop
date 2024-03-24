<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblFeeShip extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_fee_ship', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_province');
            $table->unsignedBigInteger('id_district');
            $table->unsignedBigInteger('id_wards');
            $table->string('fee_ship');
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
        Schema::dropIfExists('tbl_fee_ship');
    }
}