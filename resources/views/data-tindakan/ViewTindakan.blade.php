@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Data Tindakan</h2>
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
                    <form action="/data-tindakan/search" method="get">
                        <input class="form-control" type="text" name="key" placeholder="Pencarian" value="{{ old('key') }}">
                        <input class="btn btn-success btn-sm" type="submit" value="Cari">
                    </form>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-3 pl-5">
                        <a href="/data-tindakan/add" class="btn btn-primary btn-sm ml-3"><i class="fas fa-medkit"></i> Tambah Data Tindakan</a>
                    </div>
                </div>
            </div><!--end card header-->

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered first">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th width="5%" rowspan="2" class="align-middle">No</th>
                                <th width="38%" rowspan="2" class="align-middle">Tindakan</th>
                                <th width="15%" rowspan="2" class="align-middle">Biaya</th>
                                <th width="30%" colspan="2" class="p-1 m-1">Penindak</th>
                                <th width="12%" rowspan="2" class="align-middle">Option</th>
                            </tr>
                            <tr>
                                <th class="p-1 m-1">Dokter</th>
                                <th class="p-1 m-1">Perawat</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        @php $no = 1; @endphp
                        @foreach ($tindakan as $t)
                            <tr>
                                <td>@php echo $no; @endphp </td>
                                <td class="text-left">{{ $t->tindakan}}</td>
                                <td> Rp. {{ $t->biaya }}</td>
                                <td>
                                    @if(empty($t->dokter->nama))
                                        -
                                    @else
                                        {{ $t->dokter->nama }}
                                    @endif
                                </td>
                                <td>
                                    @if(empty($t->perawat->nama))
                                        -
                                    @else
                                        {{ $t->perawat->nama }}
                                    @endif
                                </td>
                                <td>
                                    <a href="/data-tindakan/edit/{{ $t->id }}" class="btn btn-sm btn-light fas fa-edit"></a>
                                    <a href="/data-tindakan/hapus/{{ $t->id }}" class="btn btn-sm btn-light fas fa-trash" onclick="return confirm('Hapus Data ini?')"></a>
                                </td>
                            </tr>
                        @php $no++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
                    <div class="pt-3">{{ $tindakan->links() }}</div>
            </div>
        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
</div>
@endsection
