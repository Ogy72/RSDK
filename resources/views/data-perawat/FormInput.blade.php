<head>
    <title>Input Data Perawat</title>
</head>
@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Input Data Perawat </h2>
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

            <div class="card-header">
                <!--error show-->
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <div class="card-body">
                <form action="/data-perawat/store" method="post">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="nip">Nomor Induk Perawat</label>
                            <input type="text" name="nip" class="form-control" placeholder="Masukkan Nip" required value="{{ old('nip') }}">
                        </div>
                        <div class="form-group col-8">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required value="{{ old('nama') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="jk">Jenis Kelamin</label>
                            <div class=form-inline>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="jk" class="custom-control-input" value="Laki-laki" @if(old('jk')=='Laki-laki') checked @endif>
                                    <span class="custom-control-label">Laki-laki</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="jk" class="custom-control-input" value="Perempuan" @if(old('jk')=='Perempuan') checked @endif>
                                    <span class="custom-control-label">Perempuan</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-8">
                            <label for="spesialis">Poli</label>
                            <input type="text" name="poli" class="form-control" placeholder="Poli Perawat Bertugas" required value="{{ old('poli') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="no_telp">Nomor Telepon</label>
                            <input type="text" name="no_telp" class="form-control" placeholder="Masukkan Nomor Telepon/Hp Perawat" required value="{{ old('no_telp') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" cols="5" rows="1">{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-9">
                            <input type="submit" value="Simpan" class="btn btn-primary btn-sm w-100">
                        </div>
                        <div class="form-group col-3">
                            <a href="/data-perawat" class="btn btn-danger btn-sm w-100">Batal</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
<!-- ============================================================== -->
<!-- end validation form -->
<!-- ============================================================== -->
</div>
@endsection
