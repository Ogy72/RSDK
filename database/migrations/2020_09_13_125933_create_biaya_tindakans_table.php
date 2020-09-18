<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiayaTindakansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biaya_tindakan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tindakan', 50);
            $table->integer('biaya')->unsigned();
            $table->string('dokter_nid', 12)->nullable();
            $table->string('perawat_nip', 12)->nullable();
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
        Schema::dropIfExists('biaya_tindakan');
    }
}
