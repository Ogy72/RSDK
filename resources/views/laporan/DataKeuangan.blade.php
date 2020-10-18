@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Laporan Data Pembayaran</h2>
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
                    <form action="/laporan/keuangan" method="get">
                        <input class="form-control" type="date" name="date1" required>
                        <input class="form-control" type="date" name="date2" required>
                        <input class="btn btn-primary btn-sm" type="submit" value="Proses">
                    </form>
                    </div>
                </div>
            </div><!--end card header-->

            <div class="card-body">
            @if(!empty($keuangan))
                <div class="table-responsive">
                    <table class="table table-bordered first">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">No RM</th>
                                <th width="20%">Tanggal Transaksi</th>
                                <th width="40%">Nama</th>
                                <th width="15%">Total Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach ($keuangan as $k)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $k->rekam_medis->pasien_no_rm }} </td>
                                <td>{{ $k->tgl_bayar}} </td>
                                <td>{{ $k->rekam_medis->pasien->nama }}</td>
                                <td class="text-center">Rp. {{ $k->total }}</td>
                            </tr>
                        @php $no++ @endphp
                        @endforeach
                        <tr class="text-dark">
                            <td colspan="4">Total Pendapatan</td>
                            <td class="text-center">Rp. {{ $jumlah }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endif
            </div>
            @if(!empty($keuangan))
                <a href="/laporan/keuangan/print/{{$date1}}/{{$date2}}" target="_blank" class="btn btn-sm btn-success w-100"><i class="icon-printer"></i> Print Laporan Data Pembayaran</a>
            @endif
        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
</div>
@endsection
