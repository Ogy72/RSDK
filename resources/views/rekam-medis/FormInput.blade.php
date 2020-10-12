<head>
    <title>Input Data Rekam Medis</title>
</head>
@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Input Data Rekam Medis</h2>
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
                <form action="/rekam-medis/store/{{ $rm_pasien }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-4"></div>
                        <div class="form-group col-4">
                            <label for="penyakit">Penyakit</label>
                            <select name="penyakit" class="form-control" required>
                                <option value="">Pilih Penyakit</option>
                                @foreach ($penyakit as $p)
                                    <option value="{{ $p->id }}">{{ $p->nm_penyakit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-4"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4"></div>
                        <div class="form-group col-4">
                        </div>
                        <div class="form-group col-4"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4"></div>
                        <div class="form-group col-3">
                            <input type="submit" value="Simpan" class="btn btn-primary btn-sm w-100">
                        </div>
                        <div class="form-group col-1">
                            <a href="/rekam-medis/detail/{{ $rm_pasien }}" class="btn btn-danger btn-sm w-100">Batal</a>
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
