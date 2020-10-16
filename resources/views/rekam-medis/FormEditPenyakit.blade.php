<head>
    <title>Edit Penyakit</title>
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
                <h2 class="pageheader-title">Edit Penyakit</h2>
            </div>

            <div class="card-body">
                <form action="/rekam-medis/update-penyakit/{{ $prm->id }}" method="post">
                    @csrf
                    <input type="hidden" name="pasien_no_rm" value="{{ $no_rm }}">
                   <div class="form-row">
                        <div class="form-group col-2"></div>
                        <div class="form-group col-8">
                            <label for="penyakit">Penyakit</label>
                            <select name="penyakit_id" class="form-control" id="form-penyakit" required>
                                <option value="">Pilih Penyakit</option>
                                @foreach ($penyakit as $p)
                                    @if($p_id == $p->id)
                                        <option value="{{ $p->id }}" selected>{{ $p->nm_penyakit }}</option>
                                    @else
                                        <option value="{{ $p->id }}">{{ $p->nm_penyakit }}</option>
                                    @endif
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
                            <a href="/rekam-medis/detail/{{ $no_rm }}" class="btn btn-danger btn-sm w-100">Batal</a>
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
