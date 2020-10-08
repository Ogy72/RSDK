<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Pasien;
use App\RekamMedis;
use Alert;

class RmController extends Controller
{
    //Autentifikasi
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Menampilkan Daftar Pasien
     public function view(){
        if(Gate::authorize('isAdminRm')){
            $pasien = Pasien::orderBy('updated_at', 'DESC')->paginate(5);
            return view('rekam-medis.ViewPasien', compact('pasien'));
        }
    }


}
