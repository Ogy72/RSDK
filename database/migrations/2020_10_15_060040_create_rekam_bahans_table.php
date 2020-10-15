<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamBahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahan_pakai_rekam_medis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bahan_pakai_id')->unsigned();
            $table->integer('rekam_medis_id')->unsigned();
            $table->integer('penggunaan')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bahan_pakai_rekam_medis');
    }
}
