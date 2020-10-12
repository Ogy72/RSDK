<head>
    <title>Info Perawat</title>
</head>
@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Info Perawat</h2>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end pageheader -->
<!-- ============================================================== -->

<div class="row">
<!-- ============================================================== -->
<!-- validation form -->
<!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">

            <div class="card-header text-right">
               <a href="/data-perawat" class="btn btn-primary btn-sm">Kembali <i class="fas fa-angle-right"></i></a>
            </div>

            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="nip">Nomor Induk Perawat</label>
                        <input type="text" name="nip" class="form-control" placeholder="Masukkan Nip" readonly value="{{ $perawat->nip }}">
                    </div>
                    <div class="form-group col-8">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" readonly value="{{ $perawat->nama }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="jk">Jenis Kelamin</label>
                        <input type="text" class="form-control" readonly value="{{ $perawat->jk }}">
                    </div>
                    <div class="form-group col-8">
                        <label for="poli">Poli</label>
                        <input type="text" name="poli" class="form-control" readonly value="{{ $perawat->poli }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="no_telp">Nomor Telepon</label>
                        <input type="text" name="no_telp" class="form-control" readonly value="{{ $perawat->no_telp }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control" cols="5" rows="1" readonly>{{ $perawat->alamat }}</textarea>
                    </div>
                </div>
            </div>

        </div>
    </div>
<!-- ============================================================== -->
<!-- end validation form -->
<!-- ============================================================== -->
</div>
@endsection
