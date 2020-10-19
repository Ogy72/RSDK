<title>Invoice</title>
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
<h2 class="pageheader-title">Invoice Pembayaran</h2>
<p>Tanggal: @php echo Date('d M, Y'); @endphp</p>
<!-- ============================================================== -->
<!-- end pageheader -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- basic table  -->
<!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">

            <div class="card-header"><!--card header-->
                <div class="row">
                    <div class="col-12" style="margin-bottom:10px">
                        <table>
                            <tr>
                                <td width="120px">No RM</td>
                                <td>:</td>
                                <td width="270px">{{ $pasien->no_rm }}</td>
                                <td width="120px">NIK</td>
                                <td>:</td>
                                <td>{{ $pasien->nik }}</td>
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
                    <table border="1px solid" cellspacing="0">
                    @php $no = 1; @endphp
                    @foreach ($rm2 as $rm)
                       <thead>
                            <tr>
                                <th width="10px">No</th>
                                <th width="100px">Tgl Periksa</th>
                                <th width="100px">Rincian Tindakan</th>
                                <th width="75px">Biaya</th>
                                <th width="200px">Rincian Obat & Bahan Habis Pakai</th>
                                <th width="10px">Qty</th>
                                <th width="75px">Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="vertical-align:top">{{ $no }}</td>
                                <td style="vertical-align:top">
                                    @php
                                        echo date('d-m-Y', strtotime($rm->tgl_periksa));
                                    @endphp
                                </td>
                                <td style="vertical-align:top">
                                    @foreach($rm->tindakan as $t)
                                        <p>{{ $t->tindakan}}</p>
                                    @endforeach
                                </td>
                                <td style="vertical-align:top">
                                    @foreach($rm->tindakan as $t)
                                        <p>Rp. {{ $t->biaya}}</p>
                                    @endforeach
                                </td>

                                <td style="vertical-align:top">
                                    @foreach($rm->obat as $o)
                                            <p>
                                                @foreach($rm->rekam_obat as $ro)
                                                    @if($o->kd_obat == $ro->obat_kd_obat)
                                                        {{ $o->nm_obat }}
                                                    @endif
                                                @endforeach
                                            </p>
                                    @endforeach
                                    @foreach($rm->bahan_pakai as $b)
                                            <p>
                                                @foreach($rm->rekam_bahan as $bp)
                                                    @if($b->id == $bp->bahan_pakai_id)
                                                        {{ $b->bahan }}
                                                    @endif
                                                @endforeach
                                            </p>
                                    @endforeach
                                </td>
                                <td style="vertical-align:top; text-align:center">
                                    @foreach($rm->obat as $o)
                                            <p>
                                                @foreach($rm->rekam_obat as $ro)
                                                    @if($o->kd_obat == $ro->obat_kd_obat)
                                                        {{ $ro->penggunaan }}
                                                    @endif
                                                @endforeach
                                            </p>
                                    @endforeach
                                    @foreach($rm->bahan_pakai as $b)
                                            <p>
                                                @foreach($rm->rekam_bahan as $bp)
                                                    @if($b->id == $bp->bahan_pakai_id)
                                                        {{ $bp->penggunaan }}
                                                    @endif
                                                @endforeach
                                            </p>
                                    @endforeach
                                    </ul>
                                </td>
                                <td style="vertical-align:top">
                                    @foreach($rm->obat as $o)
                                            <p>
                                                @foreach($rm->rekam_obat as $ro)
                                                    @if($o->kd_obat == $ro->obat_kd_obat)
                                                        @php
                                                            echo "Rp. ".$o->harga*$ro->penggunaan;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </p>
                                    @endforeach
                                    @foreach($rm->bahan_pakai as $b)
                                            <p>
                                                @foreach($rm->rekam_bahan as $bp)
                                                    @if($b->id == $bp->bahan_pakai_id)
                                                        @php
                                                          echo "Rp. ".$b->harga*$bp->penggunaan;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </p>
                                    @endforeach
                                </td>
                            </tr>
                            <tr class="text-dark">
                                <td colspan="3">Sub Total</td>
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
                                <td colspan="3">Total</td>
                                <td colspan="4" style="text-align:center">
                                    @php
                                        $total =  $total_t+$total_bhbs;
                                    @endphp
                                    Rp. {{ $total }}
                                </td>
                            </tr>
                        @php $no++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                    <table border="1px solid" cellspacing="0" style="margin-top:20px">
                        <tr>
                            <td width="546px">Total Biaya</td>
                            <td width="150px" style="text-align:center">Rp. {{ $tagihan }}</td>
                        </tr>
                        <tr>
                            <td>Nominal yang dibayarkan</td>
                            <td style="text-align:center">Rp. {{ $nominal }}</td>
                        </tr>
                        <tr>
                            <td>Kembalian</td>
                            <td style="text-align:center">Rp. {{ $kembalian }}</td>
                        </tr>
                    </table>
                    <table style="margin-top:20px">
                        <tr>
                            <td width="650px" style="text-align:right">
                            @php
                                echo "Samarinda, ".date('d-M-Y');
                            @endphp
                            </td>
                        </tr>
                        <tr>
                            <td width="650px" height="100px" style="text-align:right"></td>
                        </tr>
                        <tr>
                            <td width="650px" style="text-align:right; padding-right:5px">
                            ( Bagian Keuangan )
                        </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
