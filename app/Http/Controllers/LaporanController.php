<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\RekamMedis;
use App\Pasien;
use Alert;
use PDF;

class LaporanController extends Controller
{
    //Autentifikasi
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Menampilkan data laporan pasien
    public function pasien(Request $request){
        if(Gate::authorize('isAdminRm')){
            if(empty($request->date1)){
                return view('laporan.DataPasien');
            } else{
                $date1 = $request->date1.' 00-00-00';
                $date2 = $request->date2.' 00-00-00';
                $pasien = Pasien::whereBetween('created_at', [$date1, $date2])->get();
                $jl = Pasien::whereBetween('created_at', [$date1, $date2])->where('jk', '=', 'Laki-laki')->count();
                $jp = Pasien::whereBetween('created_at', [$date1, $date2])->where('jk', '=', 'Perempuan')->count();
                $jumlah = $pasien->count();
                return view('laporan.DataPasien', compact('pasien', 'jumlah', 'jl', 'jp', 'date1', 'date2'));
            }
        }
    }

    //Print laporan data pasien
    public function printPasien($date1, $date2){
        if(Gate::authorize('isAdminRm')){
            $pasien = Pasien::whereBetween('created_at', [$date1, $date2])->get();
            $jl = Pasien::whereBetween('created_at', [$date1, $date2])->where('jk', '=', 'Laki-laki')->count();
            $jp = Pasien::whereBetween('created_at', [$date1, $date2])->where('jk', '=', 'Perempuan')->count();
            $jumlah = $pasien->count();
            $pdf = PDF::loadview('laporan.PrintPasien', compact('pasien', 'jumlah', 'jl', 'jp', 'date1', 'date2'));
            return $pdf->stream('Laporan Data Pasien.pdf');
        }
    }

    //Menampilkan data laporan penyakit
    public function penyakit(Request $request){
        if(Gate::authorize('isPerawat')){
            if(empty($request->date1)){
                return view('laporan.DataPenyakit');
            } else{
                $date1 = $request->date1.' 00-00-00';
                $date2 = $request->date2.' 00-00-00';
                $rm = RekamMedis::whereBetween('created_at', [$date1, $date2])->get();
                $jumlah = $rm->count();
                return view('laporan.DataPenyakit', compact('rm', 'date1', 'date2', 'jumlah'));
            }
        }
    }

    //Print laporan data penyakit
    public function printPenyakit($date1, $date2){
        if(Gate::authorize('isPerawat')){
            $rm= RekamMedis::whereBetween('created_at', [$date1, $date2])->get();
            $jumlah = $rm->count();
            $pdf = PDF::loadview('laporan.PrintPenyakit', compact('rm', 'jumlah', 'date1', 'date2'));
            return $pdf->stream('Laporan Data Penyakit.pdf');
        }
    }

}
