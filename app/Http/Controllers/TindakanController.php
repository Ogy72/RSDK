<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\BiayaTindakan;
use App\Dokter;
use App\Perawat;

class TindakanController extends Controller
{
    //Menampilkan Data Tindakan
    public function view(){
        $tindakan = BiayaTindakan::orderBy('updated_at', 'DESC')->paginate(5);
        return view('data-tindakan.ViewTindakan', compact('tindakan'));
    }

    //Menampilkan Form Input
    public function add(){
        $dokter = Dokter::all();
        $perawat = Perawat::all();
        return view('data-tindakan.FormInput', compact('dokter', 'perawat'));
    }

    //Menyimpan Data Tindakan
    public function store(Request $request){
        //Validasi Data
        $this->validate($request, [
            'biaya' => 'digits_between:3,8|numeric'
        ]);

        //Input Data Kedalam Table biaya_tindakan
        BiayaTindakan::create([
            'tindakan' => $request->tindakan,
            'biaya' => $request->biaya,
            'dokter_nid' => $request->dokter_nid,
            'perawat_nip' => $request->perawat_nip
        ]);

        Alert::toast('Data Berhasil Ditambahkan', 'success');
        return redirect('/data-tindakan');
    }

    //Fungsi Pencarian
    public function search(Request $request){
        $key = $request->key;
        $tindakan = BiayaTindakan::where('tindakan', 'LIKE', '%'.$key.'%')->paginate(5);
        return view('data-tindakan.ViewTindakan', compact('tindakan'));
    }

    //Menampilkan Form Edit
    public function edit($id){
        $tindakan = BiayaTindakan::find($id);
        $dokter = Dokter::all();
        $perawat = Perawat::all();
        return view('data-tindakan.FormEdit', compact('tindakan', 'dokter', 'perawat'));
    }

    //Update Data Tindakan
    public function update($id, Request $request){
        //Validasi Data
        $this->validate($request, [
            'biaya' =>'digits_between:3,8|numeric'
        ]);

        //Mencari dan Update Data tindakan
        $tindakan = BiayaTindakan::find($id);
        $tindakan->tindakan = $request->tindakan;
        $tindakan->biaya = $request->biaya;
        $tindakan->dokter_nid = $request->dokter_nid;
        $tindakan->perawat_nip = $request->perawat_nip;
        $tindakan->save();

        Alert::toast('Data Berhasil Diubah', 'success');
        return redirect('/data-tindakan');
    }

    //Hapus Data Tindakan
    public function destroy($id){
        //Cari Data
        $tindakan = BiayaTindakan::find($id);
        $tindakan->delete();

        Alert::toast('Data Berhasil Dihapus', 'success');
        return redirect('/data-tindakan');
    }

}
