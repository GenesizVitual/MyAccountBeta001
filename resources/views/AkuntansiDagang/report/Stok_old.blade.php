<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Stok</title>
    <link href="{{ asset('Asset/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('Asset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>
<body  style="margin-left: 10%; margin-right: 20%">
<center>
<h1>Laporan Stok</h1>
    <h6 style="text-align: center">{{ $bisnis->nama_bisnis }}</h6>
    <h6>{{ $bisnis->alamat }}</h6>
    <h6>Periode: {{ date('d-m-Y', strtotime($tgl_awal)) }} - {{ date('d-m-Y', strtotime($tgl_akhir)) }}</h6>
    <p></p>
<table border="1" cellspacing="0" style="width: 90%">
    <thead>
    <tr style="background-color: lawngreen">
        <td>No</td>
        <td>Produk</td>
        <td>Tanggal</td>
        <td>Stok</td>
    </tr>
    </thead>
    <tbody>
    @if(!empty($data))
        @foreach($data as $data_list)
            <tr>
                <td>{{ $data_list['no'] }}</td>
                <td colspan="2">{{ $data_list['nama_barang'] }}</td>
                <td></td>
            </tr>
            @if(!empty($data_list['sub_data']))
                @foreach($data_list['sub_data'] as $data_sub)
                    <tr>
                        <td colspan="2"></td>
                        <td>{{ date('d-m-Y', strtotime($data_sub['tgl'])) }}</td>
                        <td>{{ $data_sub['sisa_stok'] }}</td>
                    </tr>
                @endforeach
            @endif
        @endforeach
    @endif
    </tbody>
</table>
</center>
</body>
</html>