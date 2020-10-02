<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Perawat;
use Illuminate\Support\Facades\Gate;

class PerawatController extends Controller
{
    //Autentifikasi
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Menampilkan Data Perawat
    public function view(){
        if(Gate::authorize('isAdmin')){
            $perawat = Perawat::orderBy('updated_at', 'DESC')->paginate(5);
            return view('data-perawat.ViewPerawat', ['perawat' => $perawat]);
        }
    }

    //Menampilkan Form Input Perawat
    public function add(){
        if(Gate::authorize('isAdmin')){
            return view('data-perawat.FormInput');
        }
    }

    //Menyimpan Data Perawat
    public function store(Request $request){
        //Validasi Data
        $this->validate($request, [
            'nip' => 'required|digits_between:5,12|numeric|unique:perawat',
            'no_telp' => 'required|digits_between:11,15|numeric'
        ]);

        //Input Data Kedalam Database
        Perawat::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'jk' => $request->jk,
            'poli' => $request->poli
        ]);

        Alert::toast('Data Berhasil Ditambahkan', 'success');
        return redirect('/data-perawat');
    }

    //Fungsi Pencarian
    public function search(Request $request){
        $key = $request->key;
        $perawat = Perawat::where('nama', 'LIKE', '%'.$key.'%')->orWhere('poli', 'LIKE', '%'.$key.'%')->paginate(5);
        return view('data-perawat.ViewPerawat', ['perawat' => $perawat]);
    }

    //Menampilkan Info Perawat
    public function info($nip){
        if(Gate::authorize('isAdmin')){
            $perawat = Perawat::find($nip);
            return view('data-perawat.FormInfo', ['perawat' => $perawat]);
        }
    }

    //Menampilkan Form Edit
    public function edit($nip){
        if(Gate::authorize('isAdmin')){
            $perawat = Perawat::find($nip);
            return view('data-perawat.FormEdit', ['perawat' =>$perawat]);
        }
    }

    //Update Data Perawat
    public function update($nip, Request $request){
        //Validasi Data Perawat
        $this->validate($request, [
            'nip' => 'required|digits_between:5,12|numeric',
            'no_telp' => 'required|digits_between:11,15|numeric'
        ]);

        //Mencari Data Perawat & Upadate Data Tersebut
        $perawat = Perawat::find($nip);
        $perawat->nip = $request->nip;
        $perawat->nama = $request->nama;
        $perawat->alamat = $request->alamat;
        $perawat->no_telp = $request->no_telp;
        $perawat->jk = $request->jk;
        $perawat->poli = $request->poli;
        $perawat->save();

        Alert::toast('Data Berhasil Diubah', 'success');
        return redirect('/data-perawat');
    }

    //Hapus Data Perawat
    public function destroy($nip){
        $perawat = Perawat::find($nip);
        $perawat->delete();

        Alert::toast('Data Berhasil Di Hapus', 'success');
        return redirect('/data-perawat');
    }
}
