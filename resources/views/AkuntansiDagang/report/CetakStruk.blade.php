<div style="text-align: center">
    <h4>{{ $bisnis->nama_bisnis }}</h4>
    <h5>{{ $bisnis->alamat }}</h5>
</div>
<div >
    <center>
    <table>
        <p>Kode Transaksi :{{ $kode }}</p>
        <p>Tanggal :{{ $tgl->tgl_penjualan }}</p>
        <table border="1" style="margin-bottom: 10px; border: solid; ">

            @php($i=1)

            <tbody>
            <tr>
                <td>No</td>
                <td>Tanggal</td>
                <td>Produk</td>
                <td>Kwantitas</td>
                <td>Harga</td>
            </tr>
            @php($total = 0)
            @php($total_pajak = 0)
            @foreach($data as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ date('d-m-Y', strtotime($row->tgl_penjualan)) }}</td>
                    <td>
                        {{ $row->LinkToProduk->nama_barang }}
                    </td>
                    <td> {{ $row->kwantitas }}</td>
                    <td> {{ number_format($row->kwantitas*$row->harga,2,',','.') }}</td>
                    @php($total +=$row->kwantitas*$row->harga)
                    @php($total_pajak +=$row->jumlah_pajak)
                </tr>
            @endforeach
            <tr>
                <td colspan="4">Sub Total :</td>
                <td>{{ number_format($total,2,',','.') }}</td>
            </tr>
            <tr>
                <td colspan="4">Pajak 10%:</td>
                <td>{{ number_format($total_pajak,2,',','.') }}</td>
            </tr>
            <tr>
                <td colspan="4">Total :</td>
                <td>{{ number_format($total+$total_pajak,2,',','.') }}</td>
            </tr>
            </tbody>

        </table>
    </table>
    </center>
</div>
<script>
    window.print();
</script>