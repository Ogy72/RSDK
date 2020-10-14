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
                                <th width="4%">No</th>
                                <th width="14%">Tgl Pemeriksaan</th>
                                <th width="34%">Sakit</th>
                                <th width="17%">Tindakan</th>
                                <th width="21%">Obat/Bahan Habis Pakai</th>
                                <th width="10%">Option</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                        <p class="m-0">{{ $p->nm_penyakit }}</p>
                                        <p class="m-0">Gejala : {{ $p->gejala }}</p>
                                    @endforeach
                                </td>
                                <td style="vertical-align:top">
                                    @foreach($rm->tindakan as $t)
                                        <p class="m-0">{{ $t->tindakan}}</p>
                                        <p class="m-0">
                                            Oleh :
                                            @if(!empty($t->dokter))
                                                {{ $t->dokter->nama }}
                                            @else
                                                {{ $t->perawat->nama }}
                                            @endif
                                        </p>
                                        <hr class="m-1">
                                    @endforeach
                                </td>
                                <td>
                                    <p class="m-0">Obat: Pil Koplo, Sirup Marjan</p>
                                    <hr class="m-1">
                                    <p class="m-0">Bahan Habis Pakai: Suntikan, Perban</p>
                                </td>
                                <td class="text-center">
                                    <p class="mb-1"><a href="/rekam-medis/add-tindakan/{{ $rm->id }}" class="btn btn-sm btn-secondary btn-rounded w-100"><i class="fas fa-plus-circle"></i> Tindakan</a></p>
                                    <p class="mb-1"><a href="/rekam-medis/add-obat/{{ $rm->id }}" class="btn btn-sm btn-secondary btn-rounded w-100"><i class="fas fa-plus-circle"></i> Obat</a></p>
                                    <p class="mb-1"><a href="/rekam-medis/add-bahan-pakai/{{ $rm->id }}" class="btn btn-sm btn-secondary btn-rounded w-100"><i class="fas fa-plus-circle"></i> Bahan Pakai</a></p>
                                    <a href="/rekam-medis/edit/" class="btn btn-sm btn-light fas fa-edit"></a>
                                    <a href="/rekam-medis/hapus/{{ $rm->id }}" class="btn btn-sm btn-light fas fa-trash" onclick="return confirm('Hapus Data ini?')"></a>
                                </td>
                            </tr>
                            @php $no++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                <a href="/rekam-medis/print/{{ $pasien->no_rm }}" target="_blank" class="btn btn-sm btn-success w-100"><i class="icon-printer"></i> Print Rekam Medis</a>
        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
</div>
@endsection
