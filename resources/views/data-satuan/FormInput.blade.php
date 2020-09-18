<head>
    <title>Input Data Satuan</title>
</head>
@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Input Data Satuan</h2>
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
                <form action="/data-satuan/store" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-4"></div>
                        <div class="form-group col-4">
                            <label for="satuan">Satuan</label>
                            <input type="text" name="satuan" class="form-control" placeholder="Masukkan Satuan" required value="{{ old('satuan') }}">
                        </div>
                        <div class="form-group col-4"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4"></div>
                        <div class="form-group col-4">
                            <label for="isi">Isi Satuan</label>
                            <input type="text" name="isi" class="form-control" placeholder="Masukkan Isi" required value="{{ old('isi') }}">
                        </div>
                        <div class="form-group col-4"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4"></div>
                        <div class="form-group col-3">
                            <input type="submit" value="Simpan" class="btn btn-primary btn-sm w-100">
                        </div>
                        <div class="form-group col-1">
                            <a href="/data-satuan" class="btn btn-danger btn-sm w-100">Batal</a>
                        </div>
                        <div class="form-group col-4"></div>
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
