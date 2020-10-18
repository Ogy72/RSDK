<title>Print RM</title>
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
<table cellspacing="0"  align=center >
<tr>
    <td rowspan=2 width="120px" align="center">
        <img src='RSUD.jpg' width='110px' height='70px'>
    </td>
    <td  align=center>
        <h3>RUMAH SAKIT UMUM DAERAH (RSUD) KORPRI</h3>
    </td>
</tr>
<tr>
    <td align=center>
        Jl. Kesuma Bangsa, Sungai Pinang Luar, Kec. Samarinda Kota, Kota Samarinda, Kalimantan Timur 75242
    </td>
</tr>
</table>
<!-- ============================================================== -->
<!-- end pageheader -->
<!-- ============================================================== -->
<hr>
<!-- ============================================================== -->
<!-- basic table  -->
<!-- ============================================================== -->
<h3 align="center">Data Rekam Medis Pasien</h3>
<table>
    <tr>
        <td width="110px">No RM</td>
        <td>:</td>
        <td width="300px">{{ $pasien->no_rm }}</td>
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

<table border="1px solid" cellspacing="0" style="margin-top:20px">
    <tr>
        <th width="10px">No</th>
        <th width="70px">Tgl Periksa</th>
        <th width="150px">Sakit</th>
        <th width="100px">Tindakan</th>
        <th width="100px">Obat/Bahan Habis Pakai</th>
    </tr>
    @php $no = 1; @endphp
    @foreach ($rm as $rm)
    <tr>
        <td style="vertical-align:top">{{ $no }}</td>
        <td style="vertical-align:top">
        @php
            echo date('d-m-Y', strtotime($rm->tgl_periksa));
        @endphp
        </td>
        <td style="vertical-align:top">
            @foreach($rm->penyakit as $p)
                <p style="margin:2px">{{ $p->nm_penyakit }}</p>
                <p style="margin:2px">Gejala : {{ $p->gejala }}</p>
            @endforeach
        </td>
        <td style="vertical-align:top">
            @foreach($rm->tindakan as $t)
            <p class="m-0">
                {{ $t->tindakan }}
                Oleh :
                @if(!empty($t->dokter))
                    {{ $t->dokter->nama }}
                @else
                    {{ $t->perawat->nama }}
                @endif
            </p>
            @endforeach
        </td>
        <td style="vertical-align:top">
            @foreach($rm->obat as $o)
                <p>
                    @foreach($rm->rekam_obat as $ro)
                        @if($o->kd_obat == $ro->obat_kd_obat)
                            {{ $o->nm_obat }}
                            {{ $ro->penggunaan }}
                        @endif
                    @endforeach
                </p>
            @endforeach
            @foreach($rm->bahan_pakai as $b)
                <p>
                    @foreach($rm->rekam_bahan as $bp)
                        @if($b->id == $bp->bahan_pakai_id)
                            {{ $b->bahan }}
                            {{ $bp->penggunaan }}
                        @endif
                    @endforeach
                </p>
            @endforeach
        </td>
    </tr>
    @php $no++; @endphp
    @endforeach
</table>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->

<table style="margin-top:20px">
    <tr>
        <td width="650px" style="text-align:right">
            @php
                echo "Samarinda, ".date('d-M-Y');
            @endphp
        </td>
    </tr>
    <tr>
        <td width="650px" height="100px" style="text-align:right">
        </td>
    </tr>
    <tr>
        <td width="650px" style="text-align:right; padding-right:25px">
            ( Direktur RSUD )
        </td>
    </tr>
</table>

