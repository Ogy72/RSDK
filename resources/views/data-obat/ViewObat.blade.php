@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Data Obat</h2>
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
                    <form action="/data-obat/search" method="get">
                        <input class="form-control" type="text" name="key" placeholder="Pencarian" value="{{ old('key') }}">
                        <input class="btn btn-success btn-sm" type="submit" value="Cari">
                    </form>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-3 pl-5">
                        <a href="/data-obat/add" class="btn btn-primary btn-sm ml-3"><i class="fas fa-capsules"></i> Tambah Data Obat</a>
                    </div>
                </div>
            </div><!--end card header-->

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered first">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Kode Obat</th>
                                <th width="20%">Nama Obat</th>
                                <th width="15%">Expired</th>
                                <th width="5%">Satuan</th>
                                <th width="5%">isi</th>
                                <th width="13%" class="text-center">Harga</th>
                                <th width="5%">Stok</th>
                                <th width="12%">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach ($obat as $o)
                            <tr>
                                <td>@php echo $no; @endphp </td>
                                <td>{{ $o->kd_obat }}</td>
                                <td>{{ $o->nm_obat }}</td>
                                <td>{{ $o->expired }}</td>
                                <td>{{ $o->satuan->satuan}}</td>
                                <td>{{ $o->satuan->isi_satuan }}</td>
                                <td class="text-center">{{ $o->harga }}</td>
                                <td>{{ $o->stok }}</td>
                                <td>
                                    <a href="/data-obat/edit/{{ $o->kd_obat }}" class="btn btn-sm btn-light fas fa-edit"></a>
                                    <a href="/data-obat/hapus/{{ $o->kd_obat }}" class="btn btn-sm btn-light fas fa-trash" onclick="return confirm('Hapus Data ini?')"></a>
                                </td>
                            </tr>
                        @php $no++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pt-3">{{ $obat->links() }}</div>
            </div>
        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
</div>
@endsection
