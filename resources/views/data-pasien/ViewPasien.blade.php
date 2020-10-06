@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Data Pasien</h2>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end pageheader -->
<!-- ============================================================== -->

<div class="row">
<!-- ============================================================== -->
<!-- basic table  -->
<!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">

            <div class="card-header"><!--card header-->
                <div class="row">
                    <div class="col-5 form-inline">
                    <form action="/data-pasien/search" method="get">
                        <input class="form-control" type="text" name="key" placeholder="Pencarian" value="{{ old('key') }}">
                        <input class="btn btn-success btn-sm" type="submit" value="Cari">
                    </form>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-3 pl-5">
                        <a href="/data-pasien/add" class="btn btn-primary btn-sm ml-5"><i class="fas fa-address-card"></i> Buat KIB Pasien</a>
                    </div>
                </div>
            </div><!--end card header-->

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered first">
                        <thead class="thead-dark">
                            <tr>
                                <th width="18%">No RM</th>
                                <th width="31%">Nama</th>
                                <th width="15%">Jenis Kelamin</th>
                                <th width="20%">No Telepon</th>
                                <th width="16%">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($pasien as $p)
                            <tr>
                                <td>{{ $p->no_rm}} </td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->jk }}</td>
                                <td>{{ $p->no_telp }}</td>
                                <td>
                                    <a href="/data-pasien/edit/{{ $p->nik }}" class="btn btn-sm btn-light fas fa-edit"></a>
                                    <a href="/data-pasien/edit/{{ $p->nik }}" class="btn btn-sm btn-light fas fa-trash" onclick="return confirm('Hapus Data ini?')"></a>
                                    <a href="/data-pasien/info/{{ $p->nik }}" class="btn btn-sm btn-light fas fa-info-circle"></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pt-3">{{ $pasien->links() }}</div>
            </div>
        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
</div>
@endsection
