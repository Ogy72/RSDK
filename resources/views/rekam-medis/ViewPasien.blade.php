@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Data Pasien Rekam Medis</h2>
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
                    <form action="/rekam-medis/search" method="get">
                        <input class="form-control" type="text" name="key" placeholder="Pencarian" value="{{ old('key') }}">
                        <input class="btn btn-success btn-sm" type="submit" value="Cari">
                    </form>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-3 pl-5">
                    </div>
                </div>
            </div><!--end card header-->

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered first">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">No RM</th>
                                <th width="33%">Nama</th>
                                <th width="13%">Jenis Kelamin</th>
                                <th width="15%">Umur</th>
                                <th width="15%">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach ($pasien as $p)
                            <tr>
                                <td>@php echo $no; @endphp </td>
                                <td>{{ $p->no_rm}} </td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->jk }}</td>
                                <td>
                                    @php
                                        $thnNow = date('Y');
                                        $thnLahir = substr($p->tgl_lahir,0,4);
                                        $thn = (int) $thnNow;
                                        $lahirPasien = (int) $thnLahir;
                                        echo $umur = $thnNow-$lahirPasien;
                                    @endphp
                                    Tahun
                                </td>
                                <td>
                                    <a href="/rekam-medis/detail/{{ $p->no_rm }}" class="btn btn-sm btn-primary">Rekam Medis <i class="fas fa-clipboard-list"></i></a>
                                </td>
                            </tr>
                        @php $no++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pt-3">{{ $pasien->links() }}</div>
            </div>
        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
</div>
@endsection
