<head>
    <title>Input Obat</title>
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
                <h2 class="pageheader-title">Input Obat</h2>
            </div>

            <div class="card-body">
                <form action="/rekam-medis/input-obat/{{ $rm_id }}" method="post">
                    @csrf
                    <input type="hidden" name="pasien_no_rm" value="{{ $rm_pasien }}">
                    <div class="form-row">
                        <div class="form-group col-2"></div>
                        <div class="form-group col-5">
                            <label for="obat">Obat</label>
                            <select name="kd_obat" class="form-control" required>
                                <option value="">Pilih Obat</option>
                                @foreach ($obat as $o)
                                    <option value="{{ $o->kd_obat }}">{{ $o->nm_obat }} | Stok {{ $o->stok }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" name="jumlah" class="form-control" {{ old('jumlah') }} placeholder="Jumlah Obat Untuk Pasien" required>
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
