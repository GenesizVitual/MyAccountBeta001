<h1>Daftar Pembelian</h1>

@php($index=0)
<h4><a href="{{ url('tambah-pembelian/5') }}">Tambah Pembelian</a></h4>
@foreach($data as $kode=>$data_pembelian)
    <p >Kode Pembelian : {{ $kode }} </p>
    <form action="{{ url('ubah-pembelian/'.$kode) }}" method="post">
        {{ csrf_field() }}
        <table border="1" style="margin-bottom: 10px">

            @php($i=1)

                <tbody>
                    <tr>
                        <td colspan="5"><a href="{{ url('selipkan-pembelian/'.$kode.'/1') }}">Selipkan pembelian</a></td>
                        <td>
                            <a href="{{ url('hapus-pembelian/'.$kode) }}" onclick="return confirm('Apakah anda akan menghapus data')">Hapus Pembelian</a>
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
                    @foreach($data_pembelian as $row)
                    <tr>
                        <td><input type="hidden" name="id[]" value="{{ $row->id }}"></input>{{ $i++ }}</td>
                        <td><input type="date" name="tgl_pembelian[]" value="{{ $row->tgl_pembelian }}"></td>
                        <td>
                            <select  name="product_id[]">
                                @foreach($product as $data)
                                    <option value="{{ $data->id }}" @if($data->id==$row->product_id) selected @endif>{{ $data->nama_barang }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <input type="text" name="kwantitas[]" value="{{ $row->kwantitas }}"> <input type="hidden" name="kwantitas_lama[]" value="{{ $row->kwantitas }}"> </td>
                        <td> <input type="text" name="harga[]" value="{{ $row->harga }}"></td>
                        <td> <input type="hidden" name="status_pembayaran[]" value="{{ $row->status_pembayaran }}">{{ $row->jumlah_pajak }}</td>
                        <td> <a href="{{ url('hapus-item-pembelian/'. $row->id) }}" onclick="return confirm('Apakah anda akan menghapus data pembelian ...?')">Hapus Item Pembelian</a> </td>
                    </tr>
                    @endforeach
                </tbody>

        </table>
        <button type="submit">Simpan</button>
    </form>
@endforeach

