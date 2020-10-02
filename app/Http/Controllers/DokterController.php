<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Dokter;
use Illuminate\Support\Facades\Gate;

class DokterController extends Controller
{

    //Autentifikasi
    public function __construct()
    {
        $this->middleware('auth');
    }


    //Menampilkan Data Dokter
    public function View(){
        if(Gate::authorize('isAdmin')){
            $dokter = Dokter::orderBy('updated_at', 'DESC')->paginate(5);
            return view('data-dokter.ViewDokter', ['dokter' => $dokter]);
        }
    }

    //Menampilkan Form Input Dokter
    public function add(){
        if(Gate::authorize('isAdmin')){
            return view('data-dokter.FormInput');
        }
    }

    //Menyimpan Data Dokter
    public function store(Request $request){
        //Validasi Data
        $this->validate($request, [
            'nid' => 'required|digits_between:5,12|numeric|unique:dokter',
            'no_telp' => 'required|digits_between:11,15|numeric'
        ]);

        //Input Data Kedalam Database
        Dokter::create([
            'nid' => $request->nid,
            'nama' => $request->nama,
            'spesialis' => $request->spesialis,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'jk' => $request->jk
        ]);

        Alert::toast('Data Berhasil Ditambahkan', 'success');
        return redirect('/data-dokter');
    }

    //Fungsi Pencarian Data
    public function search(Request $request){
        $key = $request->key;
        $dokter = Dokter::where('nama', 'LIKE', '%'.$key.'%')->orWhere('spesialis', 'LIKE', '%'.$key.'%')->paginate(5);
        return view('data-dokter.ViewDokter', ['dokter' => $dokter]);
    }

    //Menampilkan Detail Data Dokter
    public function info($nid){
        if(Gate::authorize('isAdmin')){
            $dokter = Dokter::find($nid);
            return view('data-dokter.FormInfo', ['dokter' => $dokter]);
        }
    }

    //Menampilkan Form Edit
    public function edit($nid){
        if(Gate::authorize('isAdmin')){
            $dokter = Dokter::find($nid);
            return view('data-dokter.FormEdit', ['dokter' => $dokter]);
        }
    }

    //Update Data Dokter
    public function update($nid, Request $request){
        //Validasi Data Dokter
        $this->validate($request, [
            'nid' => 'required|digits_between:5,12|numeric',
            'no_telp' => 'required|digits_between:11,15|numeric'
        ]);

        //Mencari Berdasarkan id Data Dan Update Data Tersebut
        $dokter = Dokter::find($nid);
        $dokter->nid = $request->nid;
        $dokter->nama = $request->nama;
        $dokter->spesialis = $request->spesialis;
        $dokter->alamat = $request->alamat;
        $dokter->no_telp = $request->no_telp;
        $dokter->jk = $request->jk;
        $dokter->save();

        Alert::toast('Data Berhasil Diubah', 'success');
        return redirect('/data-dokter');
    }

    //Hapus Data Dokter
    public function destroy($nid){
        $dokter = Dokter::find($nid);
        $dokter->delete();

        Alert::toast('Data Berhasil Dihapus', 'success');
        return redirect('/data-dokter');
    }
    //End
}
