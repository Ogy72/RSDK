<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Pasien;
use App\RekamMedis;
use App\Keuangan;
use Alert;
use PDF;

class KeuanganController extends Controller
{
    //Autentifikasi
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Menampilkan Daftar Pasien
     public function view(){
        if(Gate::authorize('isAdminKeuangan')){
            $pasien = Pasien::orderBy('created_at', 'ASC')->paginate(5);
            return view('data-keuangan.ViewPasien', compact('pasien'));
        }
     }

    //Pencarian
    public function search(Request $request){
        $key = $request->key;
        $pasien = Pasien::where('nama', 'LIKE', '%'.$key.'%')
                ->orWhere('no_rm', 'LIKE', '%'.$key.'%')
                ->paginate(5);
        return view('data-keuangan.ViewPasien', compact('pasien'));
    }

    //Detail Tagihan
    public function detailTagihan($no_rm){
        if(Gate::authorize('isAdminKeuangan')){
            $pasien = Pasien::find($no_rm);
            $rm = RekamMedis::where('pasien_no_rm', '=', $no_rm)->get();
            return view('data-keuangan.ViewDetail', compact('pasien', 'rm'));
        }
    }

    //Menampilkan Form Payment
    public function formPayment($no_rm){
        if(Gate::authorize('isAdminKeuangan')){
            $pasien = Pasien::find($no_rm);
            $rm = RekamMedis::where('pasien_no_rm', '=', $no_rm)->get();
            return view('data-keuangan.FormPayment', compact('pasien', 'rm'));
        }
    }

    //Input Pembayaran
    public function storePayment(Request $request){
        if(Gate::authorize('isAdminKeuangan')){
            $this->validate($request, [
                'nominal' => 'required|numeric'
            ]);
        $nominal = $request->nominal;
        $tagihan = $request->tagihan;

        if($nominal>=$tagihan){
            $rm = RekamMedis::where('pasien_no_rm', '=', $request->no_rm)->get();
            foreach($rm as $rm){
                $total_t = 0;
                $total_o = 0;
                $total_b = 0;
                $total_obhp = 0;
                if(empty($rm->keuangan)){
                    //Hitung Biaya Tindakan
                    foreach($rm->tindakan as $t){
                        $total_t = $total_t+$t->biaya;
                    }
                    //Hitung Biaya Obat
                    foreach($rm->obat as $o){
                        foreach($rm->rekam_obat as $ro){
                            if($o->kd_obat == $ro->obat_kd_obat){
                                $b_obat = $o->harga*$ro->penggunaan;
                                $total_o = $total_o+$b_obat;
                            }
                        }
                    }

                    //Hitung Biaya Bahan Habis Pakai
                    foreach($rm->bahan_pakai as $bp){
                        foreach($rm->rekam_bahan as $rb){
                            if($bp->id == $rb->bahan_pakai_id){
                                $b_bahan = $bp->harga*$rb->penggunaan;
                                $total_b = $total_b+$b_bahan;
                            }
                        }
                    }

                    //Hiitung Total Obat dan Bahan Habis Pakai
                    $total_obhp = $total_o+$total_b;

                    //Total Biaya Setiap Rekam Medis
                    $total = $total_t+$total_obhp;

                    //Store ke table keuangan
                    Keuangan::create([
                        'rekam_medis_id' => $rm->id,
                        'tgl_bayar' => date('Y-m-d'),
                        'total' => $total
                    ]);
                }
            }
            //EndAllForaech
            $kembalian = $nominal-$tagihan;
            echo "Nominal: $nominal <br> Tagihan: $tagihan <br> Kembalian: $kembalian";
        }else{
            Alert::error('Nominal Kurang', 'Nominal Yang Anda Masukkan Kurang Dari Tagihan');
            return back();
        }
        }
    }


}
