<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    //
    protected $table = 'pasien';
    protected $primaryKey = 'no_rm';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['nik', 'nama', 'tgl_lahir', 'jk', 'agama', 'status', 'pekerjaan', 'penanggung_jawab', 'alamat', 'no_telp', 'no_rm'];
}
