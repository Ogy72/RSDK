<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->string('nik', 17)->primary();
            $table->string('nama', 50);
            $table->date('tgl_lahir');
            $table->string('jk', 10);
            $table->string('agama', 25);
            $table->string('status', 20);
            $table->string('pekerjaan', 100);
            $table->string('penanggung_jawab', 50);
            $table->string('alamat', 255);
            $table->string('no_telp', 15);
            $table->string('no_rm', 25);
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
        Schema::dropIfExists('pasien');
    }
}
