<head>
    <title>Info Data Pasien</title>
</head>
@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Info Data Pasien</h2>
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
                <form action="" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="nid">Nomor RM</label>
                            <input type="text" name="no_rm" class="form-control" value="{{ $pasien->no_rm }}" readonly>
                        </div>
                        <div class="form-group col-4"></div>
                        <div class="form-group col-4">
                            <label for="nid">Nomor Induk KTP</label>
                            <input type="text" name="nik" class="form-control" value="{{ $pasien->nik }}" readonly>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="{{ $pasien->nama }}" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" value="{{ $pasien->tgl_lahir }}" readonly>
                        </div>
                         <div class="form-group col-4">
                             <label for="jk">Jenis Kelamin</label>
                             <input type="text" class="form-control" value="{{ $pasien->jk }}" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="agama">Agama</label>
                            <input type="text" class="form-control"  value="{{ $pasien->agama }}" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="statu">Status</label>
                            <input type="text" class="form-control" value="{{ $pasien->status }}" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control" value="{{ $pasien->pekerjaan }}" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="no_telp">Nomor Telepon</label>
                            <input type="text" name="no_telp" class="form-control" value="{{ $pasien->no_telp }}" readonly>
                        </div>
                        <div class="form-group col-8">
                            <label for="penanggung">Penanggung Jawab</label>
                            <input type="text" name="penanggung_jawab" class="form-control" value="{{ $pasien->penanggung_jawab }}" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" cols="5" rows="1" readonly>{{ $pasien->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-9">
                            <a href="/data-pasien/print_kib/{{ $pasien->no_rm }}" target="_blank" class="btn btn-primary btn-sm w-100">Print KIB</a>
                        </div>
                        <div class="form-group col-3">
                            <a href="/data-pasien" class="btn btn-danger btn-sm w-100">Kembali</a>
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
