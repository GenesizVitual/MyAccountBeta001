<h1>Pembelian</h1>

<form action="{{ url('pembelian-store') }}" method="post">
    <p> Kode Transaksi <input type="text" name="kode" value="{{ $kode }}" readonly></p>
    <p>
      Tanggal: <input type="date" name="tgl_pembelian">
    </p>
    @for($i=1; $i<=$range; $i++)
       <div style="border-style: solid;border-color: #00AAAA; margin-bottom: 10px">
        <p>
           Product: <select  name="product_id[]">
                @foreach($product as $data)
                    <option value="{{ $data->id }}">{{ $data->nama_barang }}</option>
                @endforeach
            </select>
        </p>
        <p>
           Kwantitas: <input type="text" name="kwantitas[]">
        </p>
        <p>
           Harga: <input type="text" name="harga[]">
        </p>
       </div>
    @endfor
    <p>
       Status Pembayaran: <br>
        <input type="radio" name="status_pembayaran" value="Cash"> Tunai <br>
        <input type="radio" name="status_pembayaran" value="Kredit"> Kredit <br>
    </p>
    {{ csrf_field() }}
    <button type="submit">Simpan</button>
</form>