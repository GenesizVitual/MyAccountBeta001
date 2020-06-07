<h1>{{ $judul }}</h1>

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