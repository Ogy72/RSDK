@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Laporan Data Pasien</h2>
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
                    <h4 class="pl-3 mb-0">Pilih Periode Laporan</h4>
                    <div class="col-12 form-inline">
                    <form action="/laporan/pasien" method="get">
                        <input class="form-control" type="date" name="date1" required>
                        <input class="form-control" type="date" name="date2" required>
                        <input class="btn btn-primary btn-sm" type="submit" value="Proses">
                    </form>
                    </div>
                </div>
            </div><!--end card header-->

            <div class="card-body">
            @if(!empty($pasien))
                <div class="table-responsive">
                    <table class="table table-bordered first">
                        <thead class="thead-dark">
                            <tr>
                                <th width="12%">No RM</th>
                                <th width="15%">No KTP</th>
                                <th width="31%">Nama</th>
                                <th width="13%">Jenis Kelamin</th>
                                <th width="13%">No Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($pasien as $p)
                            <tr>
                                <td>{{ $p->no_rm}} </td>
                                <td>{{ $p->nik}} </td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->jk }}</td>
                                <td>{{ $p->no_telp }}</td>
                            </tr>
                        @endforeach
                        <tr class="text-dark">
                            <td colspan="4">Jumlah Pasien Laki-laki</td>
                            <td class="text-center">{{ $jl }}</td>
                        </tr>
                        <tr class="text-dark">
                            <td colspan="4">Jumlah Pasien Perempuan</td>
                            <td class="text-center">{{ $jp }}</td>
                        </tr>
                        <tr class="text-dark">
                            <td colspan="4">Total Pasien</td>
                            <td class="text-center">{{ $jumlah }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endif
            </div>
            @if(!empty($pasien))
                <a href="/laporan/pasien/print/{{$date1}}/{{$date2}}" target="_blank" class="btn btn-sm btn-success w-100"><i class="icon-printer"></i> Print Laporan Data Pasien</a>
            @endif
        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
</div>
@endsection
