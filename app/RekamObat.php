<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekamObat extends Model
{
    //
    protected $table = "obat_rekam_medis";
    protected $fillable = ['obat_kd_obat', 'rekam_medis_id', 'penggunaan' ];

    public function rekam_medis(){
        return $this->belongsTo('App\RekamMedis');
    }
}
