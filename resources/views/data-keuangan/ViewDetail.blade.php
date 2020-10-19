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
    <div class="col-2 pl-5">
        <div class="page-header">
            <a href="/data-keuangan" class="btn btn-sm btn-primary ml-4">Kembali <i class="fas fa-angle-right"></i></a>
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
                    <div class="col-12">
                        <table class="table">
                            <tr>
                                <td width="12%">No RM</td>
                                <td width="2%">:</td>
                                <td width="20%">{{ $pasien->no_rm }}</td>
                                <td width="11%" class="text-right">NIK</td>
                                <td width="2%">:</td>
                                <td width="53%">{{ $pasien->nik }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $pasien->nama }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td>:</td>
                                <td>
                                    @php
                                        $thnNow = date('Y');
                                        $thnLahir = substr($pasien->tgl_lahir,0,4);
                                        $thn = (int) $thnNow;
                                        $lahirPasien = (int) $thnLahir;
                                        echo $umur = $thnNow-$lahirPasien;
                                    @endphp
                                    Tahun
                                </td>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td>
                                    @php
                                    echo date('d F Y', strtotime($pasien->tgl_lahir));
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{ $pasien->jk }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div><!--end card header-->

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered first">
                    @foreach ($rm as $rm)
                        @if(empty($rm->keuangan))
                       <thead class="thead-dark">
                            <tr>
                                <th width="15%">Tgl Periksa</th>
                                <th width="20%">Rincian Tindakan</th>
                                <th width="15%">Biaya</th>
                                <th width="25%">Rincian Obat & Bahan Habis Pakai</th>
                                <th width="5%">Qty</th>
                                <th width="15%">Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="vertical-align:top">
                                    @php
                                        echo date('d-m-Y', strtotime($rm->tgl_periksa));
                                    @endphp
                                </td>
                                <td style="vertical-align:top">
                                    <ul class="list-group list-group-flush">
                                    @foreach($rm->tindakan as $t)
                                        <li class="list-group-item pl-0 pr-0 pt-1 pb-1">
                                            <p class="m-0">
                                                {{ $t->tindakan}}
                                            </p>
                                        </li>
                                    @endforeach
                                    </ul>
                                </td>
                                <td style="vertical-align:top">
                                    <ul class="list-group list-group-flush">
                                    @foreach($rm->tindakan as $t)
                                        <li class="list-group-item pl-0 pr-0 pt-1 pb-1">
                                            <p class="m-0">
                                                Rp. {{ $t->biaya}}
                                            </p>
                                        </li>
                                    @endforeach
                                    </ul>
                                </td>

                                <td style="vertical-align:top">
                                    <ul class="list-group list-group-flush">
                                    @foreach($rm->obat as $o)
                                        <li class="list-group-item pl-0 pr-0 pt-1 pb-1">
                                            <p class="m-0">
                                                @foreach($rm->rekam_obat as $ro)
                                                    @if($o->kd_obat == $ro->obat_kd_obat)
                                                        {{ $o->nm_obat }}
                                                    @endif
                                                @endforeach
                                            </p>
                                        </li>
                                    @endforeach
                                    @foreach($rm->bahan_pakai as $b)
                                        <li class="list-group-item pl-0 pr-0 pt-1 pb-1">
                                            <p class="m-0">
                                                @foreach($rm->rekam_bahan as $bp)
                                                    @if($b->id == $bp->bahan_pakai_id)
                                                        {{ $b->bahan }}
                                                    @endif
                                                @endforeach
                                            </p>
                                        </li>
                                    @endforeach
                                    </ul>
                                </td>
                                <td style="vertical-align:top">
                                    <ul class="list-group list-group-flush">
                                    @foreach($rm->obat as $o)
                                        <li class="list-group-item pl-0 pr-0 pt-1 pb-1">
                                            <p class="m-0">
                                                @foreach($rm->rekam_obat as $ro)
                                                    @if($o->kd_obat == $ro->obat_kd_obat)
                                                        {{ $ro->penggunaan }}
                                                    @endif
                                                @endforeach
                                            </p>
                                        </li>
                                    @endforeach
                                    @foreach($rm->bahan_pakai as $b)
                                        <li class="list-group-item pl-0 pr-0 pt-1 pb-1">
                                            <p class="m-0">
                                                @foreach($rm->rekam_bahan as $bp)
                                                    @if($b->id == $bp->bahan_pakai_id)
                                                        {{ $bp->penggunaan }}
                                                    @endif
                                                @endforeach
                                            </p>
                                        </li>
                                    @endforeach
                                    </ul>
                                </td>
                                <td style="vertical-align:top">
                                    <ul class="list-group list-group-flush">
                                    @foreach($rm->obat as $o)
                                        <li class="list-group-item pl-0 pr-0 pt-1 pb-1">
                                            <p class="m-0">
                                                @foreach($rm->rekam_obat as $ro)
                                                    @if($o->kd_obat == $ro->obat_kd_obat)
                                                        @php
                                                            echo "Rp. ".$o->harga*$ro->penggunaan;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </p>
                                        </li>
                                    @endforeach
                                    @foreach($rm->bahan_pakai as $b)
                                        <li class="list-group-item pl-0 pr-0 pt-1 pb-1">
                                            <p class="m-0">
                                                @foreach($rm->rekam_bahan as $bp)
                                                    @if($b->id == $bp->bahan_pakai_id)
                                                        @php
                                                          echo "Rp. ".$b->harga*$bp->penggunaan;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </p>
                                        </li>
                                    @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr class="text-dark">
                                <td colspan="2">Sub Total</td>
                                <td>
                                    @php
                                        $total_t = 0;
                                    @endphp
                                    @foreach($rm->tindakan as $t)
                                        @php
                                            $total_t = $total_t+$t->biaya;
                                        @endphp
                                    @endforeach
                                    @php
                                        echo "Rp. ".$total_t;
                                    @endphp
                                </td>
                                <td colspan="2"></td>
                                <td>
                                    @php
                                        $total_o = 0;
                                        $total_b = 0;
                                    @endphp
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
                                    @php
                                        $total_bhbs = $total_o+$total_b;
                                    @endphp
                                    Rp. {{ $total_bhbs }}
                                </td>
                            </tr>
                            <tr class="text-dark">
                                <td colspan="2">Total</td>
                                <td colspan="3" class="text-center">
                                    @php
                                        $total =  $total_t+$total_bhbs;
                                    @endphp
                                    Rp. {{ $total }}
                                </td>
                                <td>
                                    <a href="/data-keuangan/form-payment/{{ $rm->id }}/{{ $rm->pasien_no_rm }}" target="_blank" class="btn btn-sm btn-success w-100">Bayaran Tagihan</a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if(empty($total))
                <h5 class="text-center">Tidak Ada Tagihan</h5>
            @endif
        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
</div>
@endsection
