<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Satuan;
use Alert;
use Illuminate\Support\Facades\Gate;

class SatuanController extends Controller
{
    //Autentifikasi
    public function __construct()
    {
        $this->middleware('auth');
    }

   //Menampilkan Data Satuan
    public function view(){
        if(Gate::authorize('isAdmin')){
            $satuan = Satuan::orderBy('updated_at', 'DESC')->paginate(5);
            return view('data-satuan.ViewSatuan', compact('satuan'));
        }
    }

    //Menampilkan Form Input
    public function add(){
        if(Gate::authorize('isAdmin')){
            return view('data-satuan.FormInput');
        }
    }

    //Menyimpan Data Satuan
    public function store(Request $request){
        //Validasi Data
        $this->validate($request, [
            'satuan' => 'required|',
            'isi' => 'required|digits_between:1,4|numeric'
        ]);

        //Input Data Ke Tabel
        Satuan::create([
            'satuan' => $request->satuan,
            'isi_satuan' => $request->isi
        ]);

        Alert::toast('Data Berhasil Ditambahkan', 'success');
        return redirect('/data-satuan');
    }

    //Fungsi Pencarian
    public function search(Request $request){
        $key = $request->key;
        $satuan = Satuan::where('satuan', 'LIKE', '%'.$key.'%')->paginate(5);
        return view('data-satuan.ViewSatuan', compact('satuan'));
    }

    //Menampilkan Form Edit
    public function edit($id){
        if(Gate::authorize('isAdmin')){
            $satuan = Satuan::find($id);
            return view('data-satuan.FormEdit', compact('satuan'));
        }
    }

    //Update Data Satuan
    public function update($id, Request $request){
        //Validasi Data
        $this->validate($request, [
            'satuan' => 'required',
            'isi'=> 'required|digits_between:1,4|numeric'
        ]);

        //Cari & Update Data
        $satuan = Satuan::find($id);
        $satuan->satuan = $request->satuan;
        $satuan->isi_satuan = $request->isi;
        $satuan->save();

        Alert::toast('Data Berhasil Diubah', 'success');
        return redirect('/data-satuan');
    }

    //Hapus Data
    public function destroy($id){
        try{
            $satuan = Satuan::find($id);
            $satuan->delete();

            Alert::toast('Data Berhasil Dihapus', 'success');
            return redirect('/data-satuan');
        } catch(\Illuminate\Database\QueryException $e){
            Alert::error('Data Sedang Digunakan', 'Sehingga Tidak Dapat Dihapus');
            return redirect('/data-satuan');
        }

    }
}
