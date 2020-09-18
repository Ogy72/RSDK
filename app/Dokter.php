<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    //
    protected $table = "dokter";
    protected $primaryKey = 'nid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['nid','nama','spesialis','alamat','no_telp','jk'];

    public function tindakan(){
        return $this->hasOne('App\BiayaTindakan');
    }
}
