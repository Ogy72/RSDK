<head>
    <title>Edit Data Tindakan</title>
</head>
@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Edit Data Tindakan </h2>
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
                <form action="/data-tindakan/update/{{ $tindakan->id }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="tindakan">Tindakan</label>
                        <input type="text" name="tindakan" class="form-control" placeholder="Masukkan Tindakan" required value="{{ $tindakan->tindakan }}">
                        </div>
                        <div class="form-group col-6">
                            <label for="penindak">Pilih Penindak Dokter/Perawat</label>
                            <select class="form-control form-control-sm" name="dokter_nid">
                                <option value="">Pilih Dokter</option>
                                @foreach($dokter as $d)
                                    @if($tindakan->dokter_nid == $d->nid)
                                        <option value="{{ $d->nid }}" selected>{{ $d->nama }}</option>
                                    @else
                                        <option value="{{ $d->nid }}">{{ $d->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">Biaya Rp.</span>
                                </span>
                                <input type="text" name="biaya" class="form-control" placeholder="Biaya Tindakan" required value="{{ $tindakan->biaya }}">
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <select class="form-control form-control-sm" name="perawat_nip">
                                <option value="">Pilih Perawat</option>
                                @foreach($perawat as $p)
                                    @if($tindakan->perawat_nip == $p->nip)
                                        <option value="{{ $p->nip }}" selected>{{ $p->nama }}</option>
                                    @else
                                        <option value="{{ $p->nip }}">{{ $p->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-9">
                            <input type="submit" value="Simpan" class="btn btn-primary btn-sm w-100">
                        </div>
                        <div class="form-group col-3">
                            <a href="/data-tindakan" class="btn btn-danger btn-sm w-100">Batal</a>
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
