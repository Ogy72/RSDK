<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekamPenyakit extends Model
{
    //
    protected $table = 'penyakit_rekam_medis';
    protected $fillable = ['penyakit_id', 'rekam_medis_id'];
}
