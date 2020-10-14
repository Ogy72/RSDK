<head>
    <title>Input Tindakan</title>
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
                <h2 class="pageheader-title">Input Tindakan</h2>
            </div>

            <div class="card-body">
                <form action="/rekam-medis/input-tindakan/{{ $rm_id }}" method="post">
                    @csrf
                    <input type="hidden" name="pasien_no_rm" value="{{ $rm_pasien }}">
                    <div class="form-row">
                        <div class="form-group col-2"></div>
                        <div class="form-group col-8">
                            <label for="tindakan">Tindakan</label>
                            <select name="tindakan" class="form-control" required>
                                <option value="">Pilih Tindakan</option>
                                @foreach ($tindakan as $t)
                                    <option value="{{ $t->id }}">{{ $t->tindakan }} Oleh @if(!empty($t->dokter)) {{ $t->dokter->nama }} @else {{ $t->perawat->nama }} @endif</option>
                                @endforeach
                            </select>
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
