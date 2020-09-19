<head>
    <title>Edit Data Obat</title>
</head>
@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Edit Data Obat</h2>
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
                <form action="/data-obat/store" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="kode">Kode Obat</label>
                            <input type="text" name="kd_obat" class="form-control" placeholder="Masukkan Kode Obat" required value="{{ $obat->kd_obat }}">
                        </div>
                        <div class="form-group col-8">
                            <label for="obat">Nama Obat</label>
                            <input type="text" name="nama_obat" class="form-control" placeholder="Masukkan Nama Obat" required value="{{ $obat->nm_obat }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-2">
                            <label for="satuan">Satuan</label>
                            <select name="satuan"  class="form-control form-control-sm" required>
                                @foreach($satuan as $s)
                                    @if($obat->satuan_id == $s->id)
                                        <option value="{{ $s->id }}" selected>{{ $s->satuan }} (isi {{ $s->isi_satuan}})</option>
                                    @else
                                        <option value="{{ $s->id }}">{{ $s->satuan }} (isi {{ $s->isi_satuan}})</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label for="stok">Stok Dalam Satuan</label>
                            <input type="text" name="stok" class="form-control" placeholder="Masukkan Stok" required value="{{ $stok }}">
                        </div>
                        <div class="form-group col-2">
                            <label for="non_stok">Stok Diluar Satuan</label>
                            <input type="text" name="non_stok" class="form-control" placeholder="Masukkan Stok" value="{{ $non_stok }}">
                        </div>
                        <div class="form-group col-3">
                            <label for="expired">Tanggal Kadaluarsa</label>
                            <input type="date" name="expired" class="form-control" required value="{{ $obat->expired }}">
                        </div>
                        <div class="form-group col-3">
                            <label for="harga">Harga Obat</label>
                            <input type="text" name="harga" class="form-control" placeholder="Masukkan Harga Obat" required value="{{ $obat->harga }}">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="form-group col-9">
                            <input type="submit" value="Simpan" class="btn btn-primary btn-sm w-100">
                        </div>
                        <div class="form-group col-3">
                            <a href="/data-obat" class="btn btn-danger btn-sm w-100">Batal</a>
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
