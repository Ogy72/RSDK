<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    //
    protected $table = "penyakit";
    protected $fillable = ['nm_penyakit', 'gejala'];

    public function rekam_medis(){
        return $this->belongsToMany('App\RekamMedis');
    }
}
