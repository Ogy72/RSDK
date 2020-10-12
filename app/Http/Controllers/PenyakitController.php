<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penyakit;
use Alert;
use Illuminate\Support\Facades\Gate;

class PenyakitController extends Controller
{
    //Autentifikasi
    public function __construct()
    {
        $this->middleware('auth');
    }

   //Menampilkan Data Penyakit
    public function view(){
        if(Gate::authorize('isAdmin')){
            $penyakit = Penyakit::orderBy('updated_at', 'DESC')->paginate(5);
            return view('data-penyakit.ViewPenyakit', compact('penyakit'));
        }
    }

    //Menampilkan Form Input
    public function add(){
        if(Gate::authorize('isAdmin')){
            return view('data-penyakit.FormInput');
        }
    }

    //Menyimpan Data Penyakit
    public static function store(Request $request){
        PenyakitController::storeDataPenyakit($request);
        Alert::toast('Data Berhasil Ditambahkan', 'success');
        return redirect('/data-penyakit');
    }

    //Fungsi Validasi
    protected static function rules(){
        return [
            'nama_penyakit' => 'required|min:3',
            'gejala' => 'required'
        ];
    }

    public static function storeDataPenyakit($request){
        //Validasi Data
        $request->validate(PenyakitController::rules());

        Penyakit::create([
            'nm_penyakit' => $request->nama_penyakit,
            'gejala' => $request->gejala
        ]);
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
        if(Gate::authorize('isAdmin')){
            $penyakit = Penyakit::find($id);
            return view('data-penyakit.FormEdit', compact('penyakit'));
        }
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
