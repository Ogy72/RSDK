<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penyakit;
use Alert;

class PenyakitController extends Controller
{
    //Menampilkan Data Penyakit
    public function view(){
        $penyakit = Penyakit::orderBy('updated_at', 'DESC')->paginate(5);
        return view('data-penyakit.ViewPenyakit', compact('penyakit'));
    }

    //Menampilkan Form Input
    public function add(){
        return view('data-penyakit.FormInput');
    }

    //Menyimpan Data Penyakit
    public function store(Request $request){
        //Validasi Data
        $this->validate($request, [
            'nama_penyakit' => 'required',
            'gejala' => 'required'
        ]);

        Penyakit::create([
            'nm_penyakit' => $request->nama_penyakit,
            'gejala' => $request->gejala
        ]);

        Alert::toast('Data Berhasil Ditambahkan', 'success');
        return redirect('/data-penyakit');
    }

    //Pencarian
    public function search(Request $request){
        $key = $request->key;
        $penyakit = Penyakit::where('nm_penyakit', 'LIKE', '%'.$key.'%')
                    ->orWhere('gejala', 'LIKE', '%'.$key.'%')
                    ->paginate(5);
        return view('data-penyakit.ViewPenyakit', compact('penyakit'));
    }

    //Menampilkan Form Edit
    public function edit($id){
        $penyakit = Penyakit::find($id);
        return view('data-penyakit.FormEdit', compact('penyakit'));
    }

    //Update Data Penyakit
    public function update($id, Request $request){
        //Validasi Data
        $this->validate($request, [
            'nama_penyakit' => 'required',
            'gejala' => 'required'
        ]);

        //Mencari dan Update Data Penyakit
        $penyakit = Penyakit::find($id);
        $penyakit->nm_penyakit = $request->nama_penyakit;
        $penyakit->gejala = $request->gejala;
        $penyakit->save();

        Alert::toast('Data Berhasil Diubah', 'success');
        return redirect('/data-penyakit');
    }

    //Hapus Data Penyakit
    public function destroy($id){
        $penyakit = Penyakit::find($id);
        $penyakit->delete();

        Alert::toast('Data Berhasil Dihapus', 'success');
        return redirect('/data-penyakit');
    }
}
