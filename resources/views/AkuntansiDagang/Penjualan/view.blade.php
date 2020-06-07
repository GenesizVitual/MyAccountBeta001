<h1>Daftar Penjualan</h1>

@php($index=0)
<h4><a href="{{ url('tambah-penjualan/5') }}">Tambah Penjualan</a></h4>
@foreach($data as $kode=>$data_penjualan)
    <p >Kode Penjualan : {{ $kode }} </p>
    <form action="{{ url('ubah-penjualan/'.$kode) }}" method="post">
        {{ csrf_field() }}
        <table border="1" style="margin-bottom: 10px">

            @php($i=1)

                <tbody>
                    <tr>
                        <td colspan="5"><a href="{{ url('selipkan-penjualan/'.$kode.'/1') }}">Selipkan Penjualan</a></td>
                        <td>
                            <a href="{{ url('hapus-penjualan/'.$kode) }}" onclick="return confirm('Apakah anda akan menghapus data')">Hapus Penjualan</a>
                        </td>
                    </tr>
                    <tr>
                        <td>No</td>
                        <td>Tanggal</td>
                        <td>Produk</td>
                        <td>Kwantitas</td>
                        <td>Harga</td>
                        <td>Jumlah Pajak</td>
                        <td></td>
                    </tr>
                    @foreach($data_penjualan as $row)
                    <tr>
                        <td><input type="hidden" name="id[]" value="{{ $row->id }}"></input>{{ $i++ }}</td>
                        <td><input type="date" name="tgl_penjualan[]" value="{{ $row->tgl_penjualan }}"></td>
                        <td>
                            <select  name="product_id[]">
                                @foreach($product as $data)
                                    <option value="{{ $data->id }}" @if($data->id==$row->product_id) selected @endif>{{ $data->nama_barang }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <input type="text" name="kwantitas[]" value="{{ $row->kwantitas }}"> <input type="hidden" name="kwantitas_lama[]" value="{{ $row->kwantitas }}"></td>
                        <td> <input type="text" name="harga[]" value="{{ $row->harga }}" readonly></td>
                        <td> <input type="hidden" name="status_pembayaran[]" value="{{ $row->status_pembayaran }}">{{ $row->jumlah_pajak }}</td>
                        <td> <a href="{{ url('hapus-item-penjualan/'. $row->id) }}" onclick="return confirm('Apakah anda akan menghapus data pembelian ...?')">Hapus Item Penjualan</a> </td>
                    </tr>
                    @endforeach
                </tbody>

        </table>
        <button type="submit">Simpan</button>
    </form>
@endforeach

