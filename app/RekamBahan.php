<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekamBahan extends Model
{
    //
    protected $table = 'bahan_pakai_rekam_medis';
    protected $fillable = ['bahan_pakai_id', 'rekam_medis_id', 'penggunaan'];

    public function rekam_medis(){
        return $this->belongsTo('App\RekamMedis');
    }
}
