<head>
    <title>Print Kib Pasien</title>

    <style type="text/css">
        .boundary{
            margin-left:110px;
        }
        .space{
            padding-left:10px;
            padding-right:10px;
        }
        .head{
            font-size:17px;
            font-weight:bold;
            padding:0px;
            margin:0px;
        }
        h4{
            text-decoration:underline;
            text-align:center;
        }
        h5{
            text-decoration:underline;
            text-align:center;
        }

        .clrpad{
            margin-top:15px;
            margin-bottom:15px;
        }
        .circle{
            border:1 solid grey;
        }
        .center{
            margin-left:auto;
            margin-right:auto;
        }
        .rl{
            border-right:1 solid grey;
            border-left:1 solid grey;
        }
        .bb{
            border-bottom:1 solid grey;
        }

    </style>
</head>
<!-- ============================================================== -->
<!-- Card -->
<!-- ============================================================== -->
<div>
    <!-- Header Card -->
    <table class="center" cellspacing="0">
        <tr>
            <td class="circle" style="padding:2px">
                <img src="RSUD.jpg" width="90px" height="50px">
            </td>
            <td class="space circle">
                <p class="head">Rumah Sakit Daerah Korpri</p>
            </td>
            <td class="space circle">
                No. RM {{ $pasien->no_rm }}
            </td>
        </tr>
        <tr>
            <td colspan="3" class="rl">
                <h4>KARTU IDENTITAS BEROBAT</h4>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="rl">
            <!--Body Card -->
            <table class="center" width="90%">
                <tr>
                    <td width="25%">Nama</td>
                    <td width="5%" class="space">:</td>
                    <td width="70%">
                        {{ $pasien->nama }}
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td class="space">:</td>
                    <td>
                        @php
                            echo date('d F Y', strtotime($pasien->tgl_lahir));
                        @endphp,
                        {{ $pasien->jk }}
                    </td>
                </tr>
                <tr>
                    <td>Nomor Telepon</td>
                    <td class="space">:</td>
                    <td>
                        {{ $pasien->no_telp }}
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:top">Alamat</td>
                    <td style="vertical-align:top" class="space">:</td>
                    <td>
                        @php
                            $alamat = substr($pasien->alamat,0,45);
                            echo $alamat;
                        @endphp
                    </td>
                </tr>
            </table>

            </td>
        </tr>
        <tr>
            <td colspan="3" class="rl bb">
                <h5 class="clrpad">KARTU INI HARUS DIBAWA SETIAP KALI BEROBAT</h5>
            </td>
        </tr>

    </table>
</div>
<!-- ============================================================== -->
<!-- end card -->
<!-- ============================================================== -->

