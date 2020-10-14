<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Pasien;
use App\Penyakit;
use App\Obat;
use App\BiayaTindakan;
use App\RekamMedis;
use App\RekamPenyakit;
use App\RekamTindakan;
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
            $rm = RekamMedis::where('pasien_no_rm', '=', $no_rm)->get();
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
            $tindakan = BiayaTindakan::where('tindakan', 'LIKE', '%'.'pemeriksaan'.'%')->get();
            $penyakit = Penyakit::orderBy('nm_penyakit', 'ASC')->get();
            $rm_pasien = $no_rm;
            return view('rekam-medis.FormInput', compact('penyakit', 'rm_pasien', 'tindakan'));
        }
    }

    //Menampilkan form input tindakan
    public function addTindakan($id){
        if(Gate::authorize('isAdminRm')){
            $tindakan = BiayaTindakan::orderBy('tindakan', 'ASC')->get();
            $rm = RekamMedis::find($id);
            $rm_pasien = $rm->pasien_no_rm;
            $rm_id = $id;

            return view('rekam-medis.FormInputTindakan', compact('tindakan', 'rm_id', 'rm_pasien'));
        }
    }

    //Menampilkan form input obat
    public function addObat($id){
        if(Gate::authorize('isAdminRm')){
            $obat = Obat::orderBy('nm_obat', 'ASC')->get();
            $rm = RekamMedis::find($id);
            $rm_pasien = $rm->pasien_no_rm;
            $rm_id = $id;

            return view('rekam-medis.FormInputObat', compact('obat', 'rm_id', 'rm_pasien'));
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
        $this->storePenyakit($rm, $request);

        //Insert Tindakan
        $this->storeTindakan($rm->id, $request);

        Alert::toast('Data Rekam Medis Berhasil Ditambahkan', 'success');
        return redirect('/rekam-medis/detail/'.$no_rm);
    }

    //Input tindakan
    public function inputTindakan($rm_id, Request $request){
        $this->storeTindakan($rm_id, $request);
        Alert::toast('Data Tindakan Berhasil Ditambahkan', 'success');
        return redirect('/rekam-medis/detail/'.$request->pasien_no_rm);
    }

    //Proses Input Penyakit
    protected function storePenyakit($rm, $request){
        //Input Penyakit Baru
        if(empty($request->penyakit_id)){
            $penyakit = PenyakitController::storeDataPenyakit($request); //Access Function storeDataPenyakit In PenyakitController
            RekamPenyakit::create([
                'penyakit_id' => $penyakit->id,
                'rekam_medis_id' => $rm->id
            ]);
        } else { //Input Penyakit Dengan Pilihan
            RekamPenyakit::create([
                'penyakit_id' => $request->penyakit_id,
                'rekam_medis_id' => $rm->id
            ]);
        }
    }

    //Proses Input Detail Tindakan
    protected function storeTindakan($rm_id, $request){
        RekamTindakan::create([
            'biaya_tindakan_id' => $request->tindakan,
            'rekam_medis_id' => $rm_id
        ]);
    }

    //Hapus Rekam Medis
    public function destroy($id){
        if(Gate::authorize('isAdminRm')){
            $rm = RekamMedis::find($id);
            $rm->delete();

            Alert::toast('Data Beshasil Dihapus', 'success');
            return redirect('/rekam-medis/detail/'.$rm->pasien_no_rm);
        }
    }



}
