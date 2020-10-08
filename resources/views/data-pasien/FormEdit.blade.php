<head>
    <title>Edit Data Pasien</title>
</head>
@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Edit Data Pasien</h2>
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
                <form action="/data-pasien/update/{{ $pasien->no_rm }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-5">
                            <label for="nid">Nomor RM</label>
                            <input type="text" name="no_rm" class="form-control" value="{{ $pasien->no_rm }}" readonly>
                        </div>
                        <div class="form-group col-2"></div>
                        <div class="form-group col-5">
                            <label for="nik">NIK</label>
                            <input type="text" name="nik" class="form-control" placeholder="Masukkan Nomor Induk KTP" required value="{{ $pasien->nik }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-5">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" required value="{{ $pasien->tgl_lahir }}">
                        </div>
                        <div class="form-group col-2"></div>
                        <div class="form-group col-5">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap Pasien" required value="{{ $pasien->nama }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-5">
                            <label for="agama">Agama</label>
                            <select id="agama" name="agama" class="form-control" required>
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam" {{ $pasien->agama == "Islam" ? 'selected' : ''}} >Islam</option>
                                    <option value="Protestan" {{ $pasien->agama == "Protestan" ? 'selected' : ''}} >Protestan</option>
                                    <option value="Katolik" {{ $pasien->agama == "Katolik" ? 'selected' : ''}} >Katolik</option>
                                    <option value="Hindu" {{ $pasien->agama == "Hindu" ? 'selected' : ''}} >Hindu</option>
                                    <option value="Buddha" {{ $pasien->agama == "Buddha" ? 'selected' : ''}} >Buddha</option>
                                    <option value="Khonghucu" {{ $pasien->agama == "Khonghucu" ? 'selected' : ''}} >Khonghucu</option>
                            </select>
                        </div>
                        <div class="form-group col-2"></div>
                        <div class="form-group col-5">
                            <label for="jk">Jenis Kelamin</label>
                            <div class=form-inline>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="jk" class="custom-control-input" value="Laki-laki" @if("$pasien->jk"=='Laki-laki') checked @endif>
                                    <span class="custom-control-label">Laki-laki</span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="jk" class="custom-control-input" value="Perempuan" @if("$pasien->jk"=='Perempuan') checked @endif>
                                    <span class="custom-control-label">Perempuan</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-5">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control" placeholder="Masukkan Pekerjaan Pasien" required value="{{ $pasien->pekerjaan }}">
                        </div>
                        <div class="form-group col-2"></div>
                        <div class="form-group col-5">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="Belum Kawin" {{ $pasien->status == "Belum Kawin" ? 'selected' : ''}} >Belum Kawin</option>
                                <option value="Kawin" {{ $pasien->status == "Kawin" ? 'selected' : ''}} >Kawin</option>
                                <option value="Cerai Hidup" {{ $pasien->status == "Cerai Hidup" ? 'selected' : ''}} >Cerai Hidup</option>
                                <option value="Cerai Mati" {{ $pasien->status == "Cerai Mati" ? 'selected' : ''}} >Cerai Mati</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-5">
                            <label for="no_telp">Nomor Telepon</label>
                            <input type="text" name="no_telp" class="form-control" placeholder="Masukkan Nomor Telepon/Hp Pasien" required value="{{ $pasien->no_telp }}">
                        </div>
                        <div class="form-group col-2"></div>
                        <div class="form-group col-5">
                            <label for="penanggung">Penanggung Jawab</label>
                            <input type="text" name="penanggung_jawab" class="form-control" placeholder="Masukkan Penanggung Jawab Pasien" required value="{{ $pasien->penanggung_jawab }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" cols="5" rows="1">{{ $pasien->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-9">
                            <input type="submit" value="Simpan" class="btn btn-primary btn-sm w-100">
                        </div>
                        <div class="form-group col-3">
                            <a href="/data-pasien" class="btn btn-danger btn-sm w-100">Batal</a>
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
