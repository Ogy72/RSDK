<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Pasien;
use Alert;


class PasienController extends Controller
{
    //Autentifikasi
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Menampilkan data pasien
    public function view(){
        if(Gate::authorize('isAdminRm')){
            $pasien = Pasien::orderBy('updated_at', 'DESC')->paginate(5);
            return view('data-pasien.ViewPasien', compact('pasien'));
        }
    }

    //Menampilkan Form Add
    public function add(){
        if(Gate::authorize('isAdminRm')){
            $code = $this->autoCode();
            return view('data-pasien.FormInput', compact('code'));
        }
    }

    //Fungsi menyimpan data pasien pada table pasien
    public function store(Request $request){
        $request->validate($this->rules());

        Pasien::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'jk' => $request->jk,
            'agama' => $request->agama,
            'status' => $request->status,
            'pekerjaan' => $request->pekerjaan,
            'penanggung_jawab' => $request->penanggung_jawab,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'no_rm' => $request->no_rm
        ]);

        Alert::toast('Data Pasien Berhasil Ditambahkan', 'success');
        return redirect('/data-pasien/info/'.$request->nik);
    }

    //Menampilkan form info data pasien
    public function info($nik){
        if(Gate::authorize('isAdminRm')){
            $pasien = Pasien::find($nik);
            return view('data-pasien.FormInfo', compact('pasien'));
        }
    }

    //Fungsi Validasi
    protected function rules(){
        return [
            'nik' => 'required|min:7|max:17|unique:pasien',
            'nama' => 'required|min:3|max:50',
            'tgl_lahir' => 'required',
            'jk' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'pekerjaan' => 'required|min:5|max:100',
            'penanggung_jawab' => 'required|min:3|max:50',
            'alamat' => 'required|min:10|max:255',
            'no_telp' => 'required|alpha_num|min:11|max:15',
            'no_rm' => 'required|min:10|max:25'
        ];
    }

    //Fungsi kode automatis
    protected function autoCode(){
        //Mendefinisakan bagian-bagian kode
        $getMaxCode = Pasien::select(Pasien::raw('MAX(RIGHT(no_rm,4)) as code'))->get();
        $year = date('Y');
        $split = '-';
        $month = date('m');

        if($getMaxCode){
            //Generate kode murni
            $pureCode = $getMaxCode[0]['code'];
            $code = (int) $pureCode;
            $code++;

            //Menggabungkan bagian-bagian kode menjadi kode utuh dan return nilai
            return $realCode = $year.$split.$month.$split.sprintf("%04s", $code);
        } else{
            $code = 1;
            return $realCode = $year.$split.$month.$split.sprintf("%04s",$code);
        }
    }

}
