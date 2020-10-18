<title>Laporan</title>
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
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">

            <div class="card-header"><!--card header-->
                <h2 align="center">Laporan Data Penyakit</h2>
                <h3 align="center">
                    Periode:
                    @php
                         $d1 = substr($date1,0,10);
                         $d2 = substr($date2,0,10);
                        echo date('d-m-Y', strtotime($d1))." sd ".date('d-m-Y', strtotime($d2));
                    @endphp
                </h3>
            <div class="card-body">
                <div class="table-responsive">
                    <table border="1px solid" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="10px" style="padding:5px">No</th>
                                <th width="100px" style="padding:5px">No RM</th>
                                <th width="270px">Nama</th>
                                <th width="120px" style="padding:5px">Jenis Kelamin</th>
                                <th width="150px">Penyakit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach ($rm as $rm)
                            <tr>
                                <td style="padding:5px">{{ $no }} </td>
                                <td style="padding:5px">{{ $rm->pasien_no_rm}} </td>
                                <td style="padding:5px">{{ $rm->pasien->nama }}</td>
                                <td style="padding:5px">{{ $rm->pasien->jk }}</td>
                                <td style="padding:5px">
                                    @foreach($rm->penyakit as $p)
                                        {{ $p->nm_penyakit }}
                                    @endforeach
                                </td>
                            </tr>
                        @php $no++ @endphp
                        @endforeach
                        <tr class="text-dark">
                            <td colspan="4" style="padding:5px">Total Penyakit</td>
                            <td align="center">{{ $jumlah }}</td>
                        </tr>
                        </tbody>
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
                            <td width="650px" height="90px" style="text-align:right">
                        </td>
                        </tr>
                        <tr>
                            <td width="650px" style="text-align:right; padding-right:25px">
                            (  {{ Auth::user()->name }} )
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
</div>
