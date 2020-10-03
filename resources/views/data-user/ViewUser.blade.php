@extends('layout.HalamanUtama')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Data User</h2>
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
                    </div>
                    <div class="col-4"></div>
                    <div class="col-3 pl-5">
                        <a href="/data-user/add" class="btn btn-primary btn-sm ml-3"><i class="fas fa-user-md"></i> Tambah Data User</a>
                    </div>
                </div>
            </div><!--end card header-->

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered first">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="27%">Nama</th>
                                <th width="15%">Username</th>
                                <th width="19%">Level</th>
                                <th width="15%">No Telepon</th>
                                <th width="19%">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach ($user as $u)
                            <tr>
                                <td>@php echo $no; @endphp </td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->username }}</td>
                                <td>{{ $u->level }}</td>
                                <td>{{ $u->no_telp }}</td>
                                <td>
                                    <a href="/data-user/reset/{{ $u->id }}" class="btn btn-sm btn-light fas fa-edit">Reset Pass</a>
                                    <a href="/data-user/hapus/{{ $u->id }}" class="btn btn-sm btn-light fas fa-trash" onclick="return confirm('Hapus Data ini?')"></a>
                                </td>
                            </tr>
                        @php $no++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pt-3">{{ $user->links() }}</div>
            </div>
        </div>
    </div>
<!-- ============================================================== -->
<!-- end basic table  -->
<!-- ============================================================== -->
</div>
@endsection
