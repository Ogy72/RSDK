<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    //
    protected $table = 'keuangan';
    protected $fillable = ['rekam_medis_id', 'tgl_bayar', 'total'];

    public function rekam_medis(){
        return $this->belongsTo('App\RekamMedis');
    }
}
