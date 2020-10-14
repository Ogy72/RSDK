<head>
    <title>Input Pemeriksaan</title>
</head>
@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
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
                <h2 class="pageheader-title">Input Pemeriksaan</h2>
            </div>

            <div class="card-body">
                <form action="/rekam-medis/store/{{ $rm_pasien }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-2"></div>
                        <div class="form-group col-8">
                            <label for="pemeriksaan">Pemerikasaan</label>
                            <select name="tindakan" class="form-control" required>
                                <option value="">Pilih</option>
                                @foreach ($tindakan as $t)
                                    <option value="{{ $t->id }}">{{ $t->tindakan }} Oleh @if(!empty($t->dokter)) {{ $t->dokter->nama }} @else {{ $t->perawat->nama }} @endif</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-2"></div>
                    </div>
                   <div class="form-row">
                        <div class="form-group col-2"></div>
                        <div class="form-group col-8">
                            <label for="penyakit">Penyakit</label>
                            <div class="switch-button switch-button-xs">
                                <input type="checkbox" checked name="switch12" id="switch12">
                                <span><label for="switch12"></label></span>
                            </div>
                            <select name="penyakit_id" class="form-control" id="form-penyakit" required>
                                <option value="">Pilih Penyakit</option>
                                @foreach ($penyakit as $p)
                                    <option value="{{ $p->id }}">{{ $p->nm_penyakit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-2"></div>
                    </div>
                    <div class="form-row hide">
                        <div class="form-group col-2"></div>
                        <div class="form-group col-8">
                            <label for="penyakit">Nama Penyakit</label>
                            <input type="text" name="nama_penyakit" class="form-control" id="nama_penyakit" value="{{ old('penyakit_new') }}" required>
                        </div>
                        <div class="form-group col-2"></div>
                    </div>
                    <div class="form-row hide">
                        <div class="form-group col-2"></div>
                        <div class="form-group col-8">
                            <label for="gejala">Gejala</label>
                            <input type="text" name="gejala" class="form-control" id="gejala" value="{{ old('gejala_new') }}" required>
                        </div>
                        <div class="form-group col-2"></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-2"></div>
                        <div class="form-group col-5">
                            <input type="submit" value="Simpan" class="btn btn-primary btn-sm w-100">
                        </div>
                        <div class="form-group col-3">
                            <a href="/rekam-medis/detail/{{ $rm_pasien }}" class="btn btn-danger btn-sm w-100">Batal</a>
                        </div>
                        <div class="form-group col-2"></div>
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
