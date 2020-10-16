@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-10">
        <div class="page-header">
            <h2 class="pageheader-title">Data Rekam Medis</h2>
        </div>
    </div>
    <div class="col-2 pl-5">
        <div class="page-header">
            <a href="/rekam-medis" class="btn btn-sm btn-primary ml-4">Kembali <i class="fas fa-angle-right"></i></a>
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
                                <td style="text-align:right">
                                    <a href="/rekam-medis/add/{{ $pasien->no_rm }}" class="btn btn-sm btn-primary">Tambah Data Pemeriksaan</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div><!--end card header-->

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered first">
                        <thead class="thead-dark">
                            <tr>
                                <th width="2%">No</th>
                                <th width="47%" colspan="2">Pemeriksaan</th>
                                <th width="23%">Tindakan</th>
                                <th width="23%">Obat/Bahan Habis Pakai</th>
                                <th width="5%">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach ($rm as $rm)
                            <tr>
                                <td style="vertical-align:top" rowspan="2">{{ $no }}</td>
                                <td class="text-dark" width="10%">
                                    Tgl Periksa
                                </td>
                                <td class="text-dark" width="37%">
                                    @php
                                        echo date('d-m-Y', strtotime($rm->tgl_periksa));
                                    @endphp
                                </td>
                                <td style="vertical-align:top" rowspan="2">
                                    <ul class="list-group list-group-flush">
                                    @foreach($rm->tindakan as $t)
                                        <li class="list-group-item pl-0 pr-0 pt-1 pb-1">
                                            <p class="m-0">
                                                @foreach($rm->rekam_tindakan as $rt)
                                                    @if($t->id == $rt->biaya_tindakan_id )
                                                        <a href="/rekam-medis/hapus-tindakan/{{ $rt->id }}" class="fas fa-minus-circle" onclick="return confirm('Hapus Tindakan ini?')"></a>
                                                    @endif
                                                @endforeach
                                                {{ $t->tindakan}}
                                            </p>
                                            Oleh :
                                            @if(!empty($t->dokter))
                                                {{ $t->dokter->nama }}
                                            @else
                                                {{ $t->perawat->nama }}
                                            @endif
                                        </li>
                                    @endforeach
                                    </ul>
                                </td>
                                <td style="vertical-align:top" rowspan="2">
                                    <ul class="list-group list-group-flush">
                                    @foreach($rm->obat as $o)
                                        <li class="list-group-item pl-0 pr-0 pt-1 pb-1">
                                            <p class="m-0">
                                                @foreach($rm->rekam_obat as $ro)
                                                    @if($o->kd_obat == $ro->obat_kd_obat)
                                                        <a href="/rekam-medis/hapus-obat/{{ $ro->id }}" class="ml-2 fas fa-minus-circle" onclick="return confirm('Hapus Obat ini?')"></a>
                                                        {{ $o->nm_obat }}
                                                        <span class="badge badge-primary badge-pill">
                                                            {{ $ro->penggunaan }}
                                                        </span>
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
                                                        <a href="/rekam-medis/hapus-bahan/{{ $bp->id }}" class="ml-2 fas fa-minus-circle" onclick="return confirm('Hapus Bahan ini?')"></a>
                                                        {{ $b->bahan }}
                                                        <span class="badge badge-primary badge-pill">
                                                            {{ $bp->penggunaan }}
                                                        </span>
                                                    @endif
                                                @endforeach
                                            </p>
                                        </li>
                                    @endforeach
                                    </ul>
                                </td>
                                <td class="text-center" rowspan="2">
                                    <p class="mb-1"><a href="/rekam-medis/add-tindakan/{{ $rm->id }}" class="btn btn-sm btn-secondary btn-rounded w-100"><i class="fas fa-user-md"></i></a></p>
                                    <p class="mb-1"><a href="/rekam-medis/add-obat/{{ $rm->id }}" class="btn btn-sm btn-secondary btn-rounded w-100"><i class="fas fa-capsules fas"></i></a></p>
                                    <p class="mb-1"><a href="/rekam-medis/add-bahan/{{ $rm->id }}" class="btn btn-sm btn-secondary btn-rounded w-100"><i class="fas fa-syringe"></i></a></p>
                                </td>
                            </tr>
                            <tr>
                                <td>Sakit</td>
                                <td>
                                    @foreach($rm->penyakit as $p)
                                        <p class="m-0">{{ $p->nm_penyakit }}
                                            <a href="/rekam-medis/edit-penyakit/{{ $rm->id }}/{{ $p->id }}/{{ $rm->pasien_no_rm }}" class="ml-2 fas fa-edit"></a>
                                        </p>
                                        <p class="m-0">Gejala : {{ $p->gejala }}</p>
                                    @endforeach
                                </td>
                            </tr>
                            @php $no++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                <a href="/rekam-medis/print-rm/{{ $pasien->no_rm }}" target="_blank" class="btn btn-sm btn-success w-100"><i class="icon-printer"></i> Print Rekam Medis</a>
        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
</div>
@endsection
