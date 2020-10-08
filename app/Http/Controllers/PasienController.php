<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Pasien;
use Alert;
use PDF;


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
            'no_rm' => $request->no_rm,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'jk' => $request->jk,
            'agama' => $request->agama,
            'status' => $request->status,
            'pekerjaan' => $request->pekerjaan,
            'penanggung_jawab' => $request->penanggung_jawab,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp
        ]);

        Alert::toast('Data Pasien Berhasil Ditambahkan', 'success');
        return redirect('/data-pasien/info/'.$request->no_rm);
    }

    //Menampilkan form info data pasien
    public function info($no_rm){
        if(Gate::authorize('isAdminRm')){
            $pasien = Pasien::find($no_rm);
            return view('data-pasien.FormInfo', compact('pasien'));
        }
    }

    //Pencarian
    public function search(Request $request){
        $key = $request->key;
        $pasien = Pasien::where('nama', 'LIKE', '%'.$key.'%')
                ->orWhere('no_rm', 'LIKE', '%'.$key.'%')
                ->paginate(5);
        return view('data-pasien.ViewPasien', compact('pasien'));
    }

    //Menampilkan form edit
    public function edit($no_rm){
        if(Gate::authorize('isAdminRm')){
            $pasien = Pasien::find($no_rm);
            return view('data-pasien.FormEdit', compact('pasien'));
        }
    }

    //Update Data Pasien
    public function update($no_rm, Request $request){
        $request->validate($this->rules());

        $pasien = Pasien::find($no_rm);
        $pasien->no_rm = $request->no_rm;
        $pasien->nik = $request->nik;
        $pasien->nama = $request->nama;
        $pasien->tgl_lahir = $request->tgl_lahir;
        $pasien->jk = $request->jk;
        $pasien->agama = $request->agama;
        $pasien->status = $request->status;
        $pasien->pekerjaan = $request->pekerjaan;
        $pasien->penanggung_jawab = $request->penanggung_jawab;
        $pasien->alamat = $request->alamat;
        $pasien->no_telp = $request->no_telp;
        $pasien->save();

        Alert::toast('Data Pasien Berhasil Dirubah', 'success');
        return redirect('/data-pasien/info/'.$request->no_rm);
    }

    //Hapus Data Pasien
    public function destroy($no_rm){
        if(Gate::authorize('isAdminRm')){
            $pasien = Pasien::find($no_rm);
            $pasien->delete();
        }
        Alert::toast('Data Pasien Berhasil Dihapus', 'success');
        return back();
    }
    //Print KIB
    public function print_kib($no_rm){
        if(Gate::authorize('isAdminRm')){
            $pasien = Pasien::find($no_rm);
            $pdf = PDF::loadview('data-pasien.kib', compact('pasien'));
            return $pdf->stream('Kib_'.$pasien->no_rm.'.pdf');
        }
    }

    //Fungsi Validasi
    protected function rules(){
        return [
            'nik' => 'required|numeric|digits_between:10,17',
            'nama' => 'required|min:3|max:50',
            'tgl_lahir' => 'required',
            'jk' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'pekerjaan' => 'required|min:5|max:100',
            'penanggung_jawab' => 'required|min:3|max:50',
            'alamat' => 'required|min:10|max:255',
            'no_telp' => 'required|alpha_num|min:11|max:15'
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
