<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblReceipt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_receipt', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_supplier');
            $table->integer('total_receipt');
            $table->string('status_receipt');
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
        Schema::dropIfExists('tbl_receipt');
    }
}
