@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Data Perawat</h2>
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
                    <form action="/data-perawat/search" method="get">
                        <input class="form-control" type="text" name="key" placeholder="Pencarian" value="{{ old('key') }}">
                        <input class="btn btn-success btn-sm" type="submit" value="Cari">
                    </form>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-3 pl-5">
                        <a href="/data-perawat/add" class="btn btn-primary btn-sm ml-3"><i class="fas fa-user-plus"></i> Tambah Data Perawat</a>
                    </div>
                </div>
            </div><!--end card header-->

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered first">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="30%">Nama</th>
                                <th width="15%">Jenis Kelamin</th>
                                <th width="19%">Poli</th>
                                <th width="15%">No Telepon</th>
                                <th width="16%">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach ($perawat as $p)
                            <tr>
                                <td>@php echo $no; @endphp </td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->jk }}</td>
                                <td>{{ $p->poli }}</td>
                                <td>{{ $p->no_telp }}</td>
                                <td>
                                    <a href="/data-perawat/edit/{{ $p->nip }}" class="btn btn-sm btn-light fas fa-edit"></a>
                                    <a href="/data-perawat/hapus/{{ $p->nip }}" class="btn btn-sm btn-light fas fa-trash" onclick="return confirm('Hapus Data ini?')"></a>
                                    <a href="/data-perawat/info/{{ $p->nip }}" class="btn btn-sm btn-light fas fa-info-circle"></a>
                                </td>
                            </tr>
                        @php $no++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pt-3">{{ $perawat->links() }}</div>
            </div>
        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
</div>
@endsection
