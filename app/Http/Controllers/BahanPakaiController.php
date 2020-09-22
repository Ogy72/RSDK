<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BahanPakai;
use Alert;

class BahanPakaiController extends Controller
{
    //Menampilkan Data Bahan Habis Pakai
    public function view(){
        $bahan = BahanPakai::orderBy('updated_at', 'DESC')->paginate(5);
        return view('data-bahan.ViewBahan', compact('bahan'));
    }

    //Menampilkan Form Input
    public function add(){
        return view('data-bahan.FormInput');
    }

    //Menyimpan Data Ke Dalam Table
    public function store(Request $request){
        $this->validate($request, [
            'harga' => 'required|numeric'
        ]);

        BahanPakai::create([
            'bahan' => $request->bahan,
            'harga' => $request->harga
        ]);

        Alert::toast('Data Bahan Berhasil Ditambahkan', 'success');
        return redirect('/data-bahan');
    }

    //Fungsi Pencarian
    public function search(Request $request){
        $key = $request->key;
        $bahan = BahanPakai::where('bahan', 'LIKE', '%'.$key.'%')->orWhere('harga', 'LIKE', '%'.$key.'%')->paginate(5);
        return view('data-bahan.ViewBahan', compact('bahan'));
    }

    //Menampilkan Form Edit
    public function edit($id){
        $bahan = BahanPakai::find($id);
        return view('data-bahan.FormEdit', compact('bahan'));
    }

    //Update Data
    public function update($id, Request $request){
        $this->validate($request, [
            'harga' => 'required|numeric'
        ]);

        $bahan = BahanPakai::find($id);
        $bahan->bahan = $request->bahan;
        $bahan->harga = $request->harga;
        $bahan->save();

        Alert::toast('Data Bahan Berhasil Diubah', 'success');
        return redirect('/data-bahan');
    }

    //Hapus Data
    public function destroy($id){
        $bahan = BahanPakai::find($id);
        $bahan->delete();

        Alert::toast('Data Bahan Berhasil Dihapus', 'success');
        return back();
    }

}
