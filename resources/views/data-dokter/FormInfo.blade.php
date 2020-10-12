<head>
    <title>Info Dokter</title>
</head>
@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Info Dokter </h2>
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
               <a href="/data-dokter" class="btn btn-primary btn-sm">Kembali <i class="fas fa-angle-right"></i></a>
            </div>

            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="nid">Nomor Induk Dokter</label>
                        <input type="text" name="nid" class="form-control" placeholder="Masukkan Nid" readonly value="{{ $dokter->nid }}">
                    </div>
                    <div class="form-group col-8">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" readonly value="{{ $dokter->nama }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="jk">Jenis Kelamin</label>
                        <input type="text" class="form-control" readonly value="{{ $dokter->jk }}">
                    </div>
                    <div class="form-group col-8">
                        <label for="spesialis">Spesialis</label>
                        <input type="text" name="spesialis" class="form-control" readonly value="{{ $dokter->spesialis }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="no_telp">Nomor Telepon</label>
                        <input type="text" name="no_telp" class="form-control" readonly value="{{ $dokter->no_telp }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control" cols="5" rows="1" readonly>{{ $dokter->alamat }}</textarea>
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
