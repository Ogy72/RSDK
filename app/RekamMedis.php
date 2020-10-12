<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    //
    protected $table = 'rekam_medis';
    protected $fillable = ['pasien_no_rm', 'tgl_periksa'];

    public function pasien(){
        return $this->belongsTo('App\Pasien');
    }

    public function penyakit(){
        return $this->belongsToMany('App\Penyakit');
    }
}
