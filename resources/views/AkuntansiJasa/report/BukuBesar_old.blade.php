<h1>{{ $judul }}</h1>


@foreach($data as $akun_group)
    <p style="font-weight: bold">{{ $akun_group['kode'] }} - {{ $akun_group['nama_akun'] }} </p>
    <table border="1" style="width: 80%">
        <tr style="background-color: lawngreen; font-weight: bold ">
            <td rowspan="2">Tanggal</td>
            <td rowspan="2">No. Transaksi</td>
            <td rowspan="2">Keterangan</td>
            <td rowspan="2">Debet</td>
            <td rowspan="2">Kredit</td>
            <td colspan="2">Saldo</td>
        </tr>
        <tr style="background-color: lawngreen; font-weight: bold ">
            <td>Debet</td>
            <td>Kredit</td>
        </tr>
        @foreach($akun_group['data'] as $akun)
            <tr>
                <td>{{ $akun['tanggal_jurnal'] }}</td>
                <td>{{ $akun['nomor_transaksi'] }}</td>
                <td>{{ $akun['keterangan'] }}</td>
                <td>{{ $akun['debet'] }}</td>
                <td>{{ $akun['kredit'] }}</td>
                <td>{{ $akun['saldo_debet'] }}</td>
                <td>{{ $akun['saldo_kredit'] }}</td>
            </tr>
        @endforeach
        <tr style="background-color: #00AAAA; font-weight: bold">
            <td colspan="3" style="text-align: center">Total</td>
            <td>{{ $akun_group['total_debet'] }}</td>
            <td>{{ $akun_group['total_kredit'] }}</td>
            <td colspan="2"></td>
        </tr>
    </table>
@endforeach