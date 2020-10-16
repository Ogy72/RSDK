<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekamTindakan extends Model
{
    //
    protected $table = 'biaya_tindakan_rekam_medis';
    protected $fillable =  ['biaya_tindakan_id', 'rekam_medis_id'];

    public function rekam_medis(){
        return $this->belongsTo('App\RekamMedis');
    }
}
