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
                                    <a href="/rekam-medis/add/{{ $pasien->no_rm }}" class="btn btn-sm btn-secondary">Tambah Data Pemeriksaan</a>
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
                                <th width="3%">No</th>
                                <th width="13%">Tgl Pemeriksaan</th>
                                <th width="34%">Sakit</th>
                                <th width="20%">Tindakan</th>
                                <th width="19%">Obat/Bahan Habis Pakai</th>
                                <th width="7%">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="vertical-align:top">1</td>
                                <td>
                                    @if(!empty($rm))
                                        {{ $rm->tgl_periksa }}
                                    @else
                                        Belum Ada Rekam Medis
                                    @endif
                                </td>
                                <td>
                                    <p class="m-0">Demam Berdarah</p>
                                    <p class="m-0">Gejala : Hidung Tersumbat, Demam Tinggi, Darah Tinggi.</p>
                                </td>
                                <td>
                                    <p class="m-0">Pemerikasaan</p>
                                    <p class="m-0">Oleh : Dokter A</p>
                                    <hr class="m-1">
                                    <p class="m-0">Pengambilan Darah</p>
                                    <p class="m-0">Oleh : Perawat B</p>
                                </td>
                                <td>
                                    <p class="m-0">Obat: Pil Koplo, Sirup Marjan</p>
                                    <hr class="m-1">
                                    <p class="m-0">Bahan Habis Pakai: Suntikan, Perban</p>
                                </td>
                                <td>
                                    <p class="mb-1"><a href="/rekam-medis/edit/" class="btn btn-sm btn-light fas fa-edit"></a></p>
                                    <p class="mb-0"><a href="/rekam-medis/hapus/" class="btn btn-sm btn-light fas fa-trash" onclick="return confirm('Hapus Data ini?')"></a></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
</div>
@endsection
