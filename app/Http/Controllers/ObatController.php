<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obat;
use App\Satuan;
use Alert;
use Illuminate\Support\Facades\Gate;

class ObatController extends Controller
{
   //Autentifikasi
    public function __construct()
    {
        $this->middleware('auth');
    }

   //Menampilkan Data Obat
    public function view(){
        if(Gate::authorize('isAdmin')){
            $obat = Obat::orderBy('updated_at', 'DESC')->paginate(5);
            return view('data-obat.ViewObat', compact('obat'));
        }
    }

    //Menampilan Form Input
    public function add(){
        if(Gate::authorize('isAdmin')){
            $satuan = Satuan::orderBy('satuan', 'ASC')->get();
            return view('data-obat.FormInput', compact('satuan'));
        }
    }

    //Menyimpan Data Obat
    public function store(Request $request){
        //Validasi Data
        $this->validate($request, [
            'kd_obat' => 'required|unique:obat',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric'
        ]);

        $real_stok = $this->hitungStok($request->satuan, $request->stok, $request->non_stok);

        //Input Data Kedalam Tabel obat
        Obat::create([
            'kd_obat' => $request->kd_obat,
            'nm_obat' => $request->nama_obat,
            'satuan_id' => $request->satuan,
            'stok' => $real_stok,
            'expired' => $request->expired,
            'harga' => $request->harga
        ]);

        Alert::toast('Data Berhasil Ditambahkan', 'success');
        return redirect('/data-obat');
    }

    //Find isi
    private function findIsi($satuan_id){
        $satuan = Satuan::find($satuan_id);
        return $satuan->isi_satuan;
    }

    //Hitung Stok
    private function hitungStok($satuan_id, $stok, $non_stok){
        $isi = $this->findIsi($satuan_id);
        $stok = $stok*$isi;
        return $real_stok = $stok+$non_stok;
    }

    //Konversi Non Stok
    private function konversiNonStok($real_stok, $satuan_id){
        $isi = $this->findIsi($satuan_id);
        return $non_stok = $real_stok%$isi;
    }

    //Konversi Stok
    private function konversiStok($real_stok, $satuan_id){
        $isi = $this->findIsi($satuan_id);
        $non_stok = $this->konversiNonStok($real_stok, $satuan_id);
        $this_stok = $real_stok-$non_stok;
        return $stok = $this_stok/$isi;
    }

    //Fungsi Pencarian
    public function search(Request $request){
        $key = $request->key;
        $obat = Obat::where('kd_obat', 'LIKE', '%'.$key.'%')->orWhere('nm_obat', 'LIKE', '%'.$key.'%')->paginate(5);
        return view('data-obat.ViewObat', compact('obat'));
    }

    //Menampilkan Form Edit
    public function edit($kd_obat){
        if(Gate::authorize('isAdmin')){
            $obat = Obat::find($kd_obat);
            $satuan = Satuan::orderBy('satuan', 'ASC')->get();
            $stok = $this->konversiStok($obat->stok, $obat->satuan_id);
            $non_stok = $this->konversiNonStok($obat->stok, $obat->satuan_id);

            return view('data-obat.FormEdit', compact('obat', 'satuan', 'stok', 'non_stok'));
        }
    }

    //Update Data Obat
    public function update($kd_obat, Request $request){
        $this->validate($request, [
            'stok' => 'required|numeric',
            'non_stok' => 'numeric',
            'harga' => 'required|numeric'
        ]);

        $real_stok = $this->hitungStok($request->satuan, $request->stok, $request->non_stok);

        $obat = Obat::find($kd_obat);
        $obat->kd_obat = $request->kd_obat;
        $obat->nm_obat = $request->nama_obat;
        $obat->satuan_id = $request->satuan;
        $obat->stok = $real_stok;
        $obat->expired = $request->expired;
        $obat->harga = $request->harga;
        $obat->save();

        Alert::toast('Data Berhasil Diubah', 'success');
        return redirect('/data-obat');
    }

    //Destroy Data Obat
    public function destroy($kd_obat){
        $obat = Obat::find($kd_obat);
        $obat->delete();

        Alert::toast('Data Obat Berhasil Di Hapus', 'success');
        return back();
    }
}
