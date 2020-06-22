<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $judul }}</title>
    <link href="{{ asset('Asset/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('Asset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>
<body style="margin-left: 10%; margin-right: 10%">
<center>
<h3>{{ $judul }}</h3>
<h6 style="text-align: center">{{ $bisnis->nama_bisnis }}</h6>
<h6>{{ $bisnis->alamat }}</h6>
<h6>Periode: {{ date('d-m-Y', strtotime($tgl_awal)) }} - {{ date('d-m-Y', strtotime($tgl_akhir)) }}</h6>
<p></p>
<table border="1" style="width: 80%">
    <thead>
    <tr>
        <td>No</td>
        <td>Tanggal</td>
        <td>Produk</td>
        <td>Kwantitas</td>
        <td>Harga</td>
        <td>Total</td>
        <td>Pajak</td>
        <td>Status Pembayara</td>
    </tr>
    </thead>
    <tbody>
    @if(!empty($data))
        @foreach($data as $data_list)
            <tr>
                <td>{{ $data_list['no'] }}</td>
                <td>{{ date('d-m-Y', strtotime($data_list['tgl'])) }}</td>
                <td>{{ $data_list['product'] }}</td>
                <td>{{ $data_list['kwantitas'] }}</td>
                <td>{{ $data_list['harga'] }}</td>
                <td>{{ $data_list['total'] }}</td>
                <td>{{ $data_list['pajak'] }}</td>
                <td>{{ $data_list['status_pembayaran'] }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
</center>
</body>

</html>