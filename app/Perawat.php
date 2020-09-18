<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    //
    protected $table = "perawat";
    protected $primaryKey = "nip";
    protected $keyType = "string";
    public $incrementing = false;
    protected $fillable = ['nip','nama','alamat','no_telp','jk','poli'];

    public function tindakan(){
        return $this->hasOne('App\BiayaTindakan');
    }
}
