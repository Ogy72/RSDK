<head>
    <title>Input Bahan Habis Pakai</title>
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
                <h2 class="pageheader-title">Input Bahan Habis Pakai</h2>
            </div>

            <div class="card-body">
                <form action="/rekam-medis/input-bahan/{{ $rm_id }}" method="post">
                    @csrf
                    <input type="hidden" name="pasien_no_rm" value="{{ $rm_pasien }}">
                    <div class="form-row">
                        <div class="form-group col-2"></div>
                        <div class="form-group col-5">
                            <label for="obat">Bahan Habis Pakai</label>
                            <select name="bahan_id" class="form-control" required>
                                <option value="">Pilih Obat</option>
                                @foreach ($bahan as $b)
                                    @if(old('bahan_id') == $b->id)
                                        <option value="{{ $b->id }}" selected>{{ $b->bahan }}</option>
                                    @else
                                        <option value="{{ $b->id }}">{{ $b->bahan }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" name="jumlah" class="form-control" value="{{ old('jumlah') }}" placeholder="Jumlah Bahan Dipakai" required>
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
