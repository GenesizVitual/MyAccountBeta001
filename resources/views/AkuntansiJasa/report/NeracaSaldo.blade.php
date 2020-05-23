<h1>Neraca saldo</h1>

<table border="1" style="width: 80%">
    <tr>
        <td>Kode</td>
        <td>Keterangan</td>
        <td>Debet</td>
        <td>Kredit</td>
    </tr>
    @php($saldo_debet=0)
    @php($saldo_kredit=0)
    @foreach($data as $daftar_akun)
        @php($saldo_debet = abs($daftar_akun['saldo_debet']))
        @php($saldo_kredit = abs($daftar_akun['saldo_kredit']))
        <tr>
            <td>{{ $daftar_akun['kode'] }}</td>
            <td>{{ $daftar_akun['nama_akun'] }}</td>
            <td>{{ $saldo_debet }}</td>
            <td>{{ $saldo_kredit }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="2">Total</td>
        <td>{{ $total_debet }}</td>
        <td>{{ $total_kredit }}</td>
    </tr>
</table>