<h1>Saldo Awal</h1>

<form action="{{ url('simpan-saldo-awal-dagang') }}" method="post">
    <p>
      Tanggal: <input type="date" name="tgl_transaksi">
    </p>
    <p>
       Kode: <input type="text" name="kode">
    </p>
    <p>
       Transaksi: <input type="text" name="transaksi">
    </p>
    <p>
       Jumlah Saldo: <input type="number" name="jumlah_saldo">
    </p>
    {{ csrf_field() }}
    <button type="submit">Simpan</button>
</form>