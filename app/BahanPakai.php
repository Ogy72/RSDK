<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BahanPakai extends Model
{
    //
    protected $table = 'biaya_pakai';
    protected $fillable = ['bahan', 'harga'];

    public function rekam_medis(){
        return $this->belongsToMany('App\RekamMedis');
    }

}
