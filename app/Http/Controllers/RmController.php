<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Pasien;
use App\Penyakit;
use App\RekamMedis;
use App\RekamPenyakit;
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

    //Menampilkan detail rekam medis
    public function detailRm($no_rm){
        if(Gate::authorize('isAdminRm')){
            $pasien = Pasien::find($no_rm);
            $rm = RekamMedis::where('pasien_no_rm', '=', $no_rm)->first();
            return view('rekam-medis.ViewDetail', compact('pasien', 'rm'));
        }
    }

    //Pencarian
    public function search(Request $request){
        $key = $request->key;
        $pasien = Pasien::where('nama', 'LIKE', '%'.$key.'%')
                ->orWhere('no_rm', 'LIKE', '%'.$key.'%')
                ->paginate(5);
        return view('rekam-medis.ViewPasien', compact('pasien'));
    }

    //Menampilkan form rekam medis
    public function add($no_rm){
        if(Gate::authorize('isAdminRm')){
            $penyakit = Penyakit::orderBy('nm_penyakit', 'ASC')->get();
            $rm_pasien = $no_rm;
            return view('rekam-medis.FormInput', compact('penyakit', 'rm_pasien'));
        }
    }

    //Input Rekam Medis
    public function store($no_rm, Request $request){
        //Insert Rekam Medis
        $rm = RekamMedis::create([
            'pasien_no_rm' => $no_rm,
            'tgl_periksa' => date('Y-m-d')
        ]);

        //Insert Detail Penyakit
        RekamPenyakit::create([
            'penyakit_id' => $request->penyakit,
            'rekam_medis_id' => $rm->id
        ]);

        Alert::toast('Data Rekam Medis Berhasil Ditambahkan', 'success');
        return redirect('/rekam-medis/detail/'.$no_rm);
    }



}
