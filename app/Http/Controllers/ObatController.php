<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obat;
use App\Satuan;
use Alert;

class ObatController extends Controller
{
    //Menampilkan Data Obat
    public function view(){
        $obat = Obat::orderBy('updated_at', 'DESC')->paginate(5);
        return view('data-obat.ViewObat', compact('obat'));
    }

    //Menampilan Form Input
    public function add(){
        $satuan = Satuan::all();
        return view('data-obat.FormInput', compact('satuan'));
    }
}
