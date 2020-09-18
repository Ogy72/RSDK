<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class obat extends Model
{
    //
    protected $table = 'obat';
    protected $primaryKey = 'kd_obat';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['kd_obat', 'nm_obat', 'satuan', 'expired', 'stok', 'harga'];

    public function satuan(){
        return $this->hasOne('App\Satuan');
    }
}
