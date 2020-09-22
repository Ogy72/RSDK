<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BahanPakai extends Model
{
    //
    protected $table = 'biaya_pakai';
    protected $fillable = ['bahan', 'harga'];
}
