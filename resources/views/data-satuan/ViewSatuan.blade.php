@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Data Satuan</h2>
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
                    <form action="/data-satuan/search" method="get">
                        <input class="form-control" type="text" name="key" placeholder="Pencarian" value="{{ old('key') }}">
                        <input class="btn btn-success btn-sm" type="submit" value="Cari">
                    </form>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-3 pl-5">
                        <a href="/data-satuan/add" class="btn btn-primary btn-sm ml-3"><i class="fas fa-at"></i> Tambah Data Satuan</a>
                    </div>
                </div>
            </div><!--end card header-->

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered first">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="55%">Satuan</th>
                                <th width="28%">Isi/Satuan</th>
                                <th width="12%">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach ($satuan as $s)
                            <tr>
                                <td>@php echo $no; @endphp </td>
                                <td>{{ $s->satuan }}</td>
                                <td>{{ $s->isi_satuan }}</td>
                                <td>
                                    <a href="/data-satuan/edit/{{ $s->id }}" class="btn btn-sm btn-light fas fa-edit"></a>
                                    <a href="/data-satuan/hapus/{{ $s->id }}" class="btn btn-sm btn-light fas fa-trash" onclick="return confirm('Hapus Data ini?')"></a>
                                </td>
                            </tr>
                        @php $no++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pt-3">{{ $satuan->links() }}</div>
            </div>
        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
</div>
@endsection
