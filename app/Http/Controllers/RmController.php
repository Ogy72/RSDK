<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Pasien;
use App\Penyakit;
use App\Obat;
use App\BahanPakai;
use App\BiayaTindakan;
use App\RekamMedis;
use App\RekamPenyakit;
use App\RekamTindakan;
use App\RekamObat;
use App\RekamBahan;
use Alert;
use PDF;

class RmController extends Controller
{
    //Autentifikasi
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Menampilkan Daftar Pasien
     public function view(){
        if(Gate::authorize('isPerawat')){
            $pasien = Pasien::orderBy('updated_at', 'DESC')->paginate(5);
            return view('rekam-medis.ViewPasien', compact('pasien'));
        }
     }

    //Menampilkan detail rekam medis
    public function detailRm($no_rm){
        if(Gate::authorize('isPerawat')){
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
        if(Gate::authorize('isPerawat')){
            $tindakan = BiayaTindakan::where('tindakan', 'LIKE', '%'.'pemeriksaan'.'%')->get();
            $penyakit = Penyakit::orderBy('nm_penyakit', 'ASC')->get();
            $rm_pasien = $no_rm;
            return view('rekam-medis.FormInput', compact('penyakit', 'rm_pasien', 'tindakan'));
        }
    }

    //Menampilkan form input tindakan
    public function addTindakan($id){
        if(Gate::authorize('isPerawat')){
            $tindakan = BiayaTindakan::orderBy('tindakan', 'ASC')->get();
            $rm = RekamMedis::find($id);
            $rm_pasien = $rm->pasien_no_rm;
            $rm_id = $id;

            return view('rekam-medis.FormInputTindakan', compact('tindakan', 'rm_id', 'rm_pasien'));
        }
    }

    //Menampilkan form input obat
    public function addObat($id){
        if(Gate::authorize('isPerawat')){
            $obat = Obat::orderBy('nm_obat', 'ASC')->get();
            $rm = RekamMedis::find($id);
            $rm_pasien = $rm->pasien_no_rm;
            $rm_id = $id;

            return view('rekam-medis.FormInputObat', compact('obat', 'rm_id', 'rm_pasien'));
        }
    }

    //Menampilkan form input bahan habis pakai
    public function addBahan($id){
        if(Gate::authorize('isPerawat')){
            $bahan = BahanPakai::orderBy('bahan', 'ASC')->get();
            $rm = RekamMedis::find($id);
            $rm_pasien = $rm->pasien_no_rm;
            $rm_id = $id;

            return view('rekam-medis.FormInputBahan', compact('bahan', 'rm_id', 'rm_pasien'));
        }
    }

    //Menampilkan form edit penyakit
    public function editPenyakit($rm_id, $p_id, $no_rm){
        if(Gate::authorize('isPerawat')){
            $penyakit = Penyakit::orderBy('nm_penyakit', 'ASC')->get();
            $prm = RekamPenyakit::where('rekam_medis_id', '=', $rm_id)->first();

            return view('rekam-medis.FormEditPenyakit', compact('penyakit', 'prm', 'p_id', 'no_rm'));
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

    //Input obat
    public function inputObat($rm_id, Request $request){
        $this->validate($request, [
            'jumlah' => 'required|numeric'
        ]);

        $this->storeObat($rm_id, $request);
        Alert::toast('Data Obat Berhasil Ditambahkan', 'success');
        return redirect('/rekam-medis/detail/'.$request->pasien_no_rm);
    }

    //Input bahan pakai
    public function inputBahan($rm_id, Request $request){
        $this->validate($request, [
            'jumlah' => 'required|numeric'
        ]);

        $this->storeBahan($rm_id, $request);
        Alert::toast('Data Bahan Berhasil Ditambahkan', 'success');
        return redirect('/rekam-medis/detail/'.$request->pasien_no_rm);
    }

    //Update penyakit pasien
    public function updatePenyakit($prm_id, Request $request){
        $prm = RekamPenyakit::find($prm_id);
        $prm->penyakit_id = $request->penyakit_id;
        $prm->save();

        Alert::toast('Data Penyakit Pasien Berhasil Diubah', 'success');
        return redirect('/rekam-medis/detail/'.$request->pasien_no_rm);
    }

    //Hapus Tindakan
    public function destroyTindakan($rt_id){
        if(Gate::authorize('isPerawat')){
            $brm = RekamTindakan::find($rt_id);
            $brm->delete();

            Alert::toast('Data Tindakan Pasien Berhasil Dihapus', 'success');
            return back();
        }
    }

    //Hapus Obat
    public function destroyObat($ro_id){
        if(Gate::authorize('isPerawat')){
            $orm = RekamObat::find($ro_id);
            $kd_obat = $orm->obat_kd_obat;
            $penggunaan = $orm->penggunaan;

            $obat = Obat::find($kd_obat);
            $stok = $obat->stok;
            $restok = $stok+$penggunaan;
            $obat->stok = $restok;
            $obat->save();

            $orm->delete();

            Alert::toast('Data Obat Pasien Berhasil Dihapus', 'success');
            return back();
        }
    }


    //Hapus Bahan Pakai
    public function destroyBahan($bp_id){
        if(Gate::authorize('isPerawat')){
            $bpm = RekamBahan::find($bp_id);
            $bpm->delete();

            Alert::toast('Data Bahan Habis Pakai Berhasil Dihapus', 'success');
            return back();
        }
    }

    //Print Rekam Medis
    public function printRm($no_rm){
        if(Gate::authorize('isPerawat')){
            $pasien = Pasien::find($no_rm);
            $rm = RekamMedis::where('pasien_no_rm', '=', $no_rm)->get();
            $pdf = PDF::loadview('rekam-medis.PrintRm', compact('pasien', 'rm'));
            return $pdf->stream('Rekam_Medis_'.$pasien->no_rm.'.pdf');
        }
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

    //Proses input obat dan restok
    protected function storeObat($rm_id, $request){
        $obat = Obat::find($request->kd_obat);
        $penggunaan = $request->jumlah;
        $stok = $obat->stok;
        if($stok < $penggunaan){
            Alert::error('Stok', 'Stok Obat Tidak Mencukupi');
            return back();
        } else{
            $restok = $stok-$penggunaan;
            $obat->stok = $restok;
            $obat->save();

            RekamObat::create([
                'obat_kd_obat' => $request->kd_obat,
                'rekam_medis_id' => $rm_id,
                'penggunaan' => $penggunaan
            ]);
        }
    }

    //Proses input bahan pakai
    protected function storeBahan($rm_id, $request){
        RekamBahan::create([
            'bahan_pakai_id' => $request->bahan_id,
            'rekam_medis_id' => $rm_id,
            'penggunaan' => $request->jumlah
        ]);
    }


}
