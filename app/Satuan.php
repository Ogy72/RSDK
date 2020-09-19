<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    //
    protected $table = 'satuan';
    protected $fillable = ['satuan', 'isi_satuan'];

    public function obat(){
        return $this->hasOne('App\Obat');
    }
}
