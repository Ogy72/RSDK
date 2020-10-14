<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiayaTindakan extends Model
{
    //
    protected $table = "biaya_tindakan";
    protected $fillable = ['tindakan', 'biaya', 'dokter_nid', 'perawat_nip'];

    public function dokter(){
        return $this->belongsTo('App\Dokter');
    }

    public function perawat(){
        return $this->belongsTo('App\Perawat');
    }

    public function rekam_medis(){
        return $this->belongsToMany('App\RekamMedis');
    }


}
