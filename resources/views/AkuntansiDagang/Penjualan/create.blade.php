<h1>Penjualan</h1>

<form action="{{ url('penjualan-store') }}" method="post">
    <p>
      Tanggal: <input type="date" name="tgl_penjualan">
    </p>
    <p>
       Product: <select  name="product_id">
            @foreach($product as $data)
                <option value="{{ $data->id }}">{{ $data->nama_barang }}</option>
            @endforeach
        </select>
    </p>
    <p>
       Kwantitas: <input type="text" name="kwantitas">
    </p>
    <p>
       Harga: <input type="number" name="harga">
    </p>
    <p>
        Status Pembayaran: <br>
        <input type="radio" name="status_pembayaran" value="Cash"> Tunai <br>
        <input type="radio" name="status_pembayaran" value="Kredit"> Kredit <br>
    </p>
    <p>
        Jumlah Pajak (%): <input name="jumlah_pajak" value="10">
    </p>
    {{ csrf_field() }}
    <button type="submit">Simpan</button>
</form>