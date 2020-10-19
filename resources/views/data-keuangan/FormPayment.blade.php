@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-10">
        <div class="page-header">
            <h2 class="pageheader-title">Data Tagihan Keuangan Pasien</h2>
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
                    <div class="col-12 text-right">
                        <h3 class="mr-5 mb-0">No Rm : {{ $no_rm }}</h3>
                    </div>
                </div>
            </div><!--end card header-->

            <div class="card-body ml-5 mr-5">
                <div class="table-responsive">
                    <table class="table table-bordered first">
                       <thead class="thead-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="45%">Tanggal Pemeriksaan</th>
                                <th width="45%" class="text-center">Total Biaya</th>
                            </tr>
                        </thead>
                        @php
                            $no = 1;
                            $yg_harus_dibayar = 0;
                        @endphp
                        <tbody>
                        @foreach ($rm as $rm)
                        @if(empty($rm->keuangan))
                            <tr>
                                <td>{{ $no }}</td>
                                <td>
                                    @php
                                        echo date('d-m-Y', strtotime($rm->tgl_periksa));
                                    @endphp
                                </td>
                                    <!-- Inisialisasi Variabel Total -->
                                    @php
                                        $total_t = 0;
                                        $total_o = 0;
                                        $total_b = 0;
                                    @endphp
                                    <!-- Hitung Total Biaya Tindakan -->
                                    @foreach($rm->tindakan as $t)
                                        @php
                                            $total_t = $total_t+$t->biaya;
                                        @endphp
                                    @endforeach
                                    <!-- Hitung Biaya Obat -->
                                    @foreach($rm->obat as $o)
                                        @foreach($rm->rekam_obat as $ro)
                                            @if($o->kd_obat == $ro->obat_kd_obat)
                                                @php
                                                    $b_obat = $ro->penggunaan*$o->harga;
                                                    $total_o = $total_o+$b_obat;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <!-- Hitung Biaya Bahan Habis Pakai -->
                                    @foreach($rm->bahan_pakai as $b)
                                        @foreach($rm->rekam_bahan as $bp)
                                            @if($b->id == $bp->bahan_pakai_id)
                                                @php
                                                    $b_bahan = $bp->penggunaan*$b->harga;
                                                    $total_b = $total_b+$b_bahan;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <!-- Hitung Total Obat dan Biaya Bahan Habis Pakai -->
                                    @php
                                        $total_bhbs = $total_o+$total_b;
                                    @endphp
                                <td class="text-center">
                                    <!-- Hitung Total Biaya -->
                                    @php
                                        $total =  $total_t+$total_bhbs;
                                        $yg_harus_dibayar = $yg_harus_dibayar+$total;
                                    @endphp
                                    Rp. {{ $total }}
                                </td>
                            </tr>
                            @php $no++; @endphp
                            @endif
                            @endforeach
                            <tr>
                                <td colspan="2">Jumlah Yang Harus Dibayar</td>
                                <td class="text-center">
                                    Rp. {{ $yg_harus_dibayar }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                    <form action="/data-keuangan/payment/store" method="post">
                        @csrf
                        <input type="hidden" name="no_rm" value="{{ $no_rm }}">
                        <input type="hidden" name="rm_id" value="{{ $rm_id }}">
                        <input type="hidden" name="tagihan" value="{{ $yg_harus_dibayar }}">
                        <input type="text" name="nominal" class="form-control mt-3 mb-2" value="{{ old('nominal') }}" placeholder="Masukkan Nominal Pembayaran" required>
                        <input type="submit" value="Proses" class="btn btn-sm btn-primary w-100">
                    </form>
                </div>
            </div>

        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
</div>
@endsection
