@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Pembelian</h1>

<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pembelian</h6>
                <div class="dropdown no-arrow">
                    <a href="{{ url('tambah-pembelian/5') }}" class="btn btn-primary" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus fa-sm fa-fw text-gray-400"></i> Pembelian
                    </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Halaman ini akan menampilkan seluruh produk yang ada dioutlet anda</p>
                @include('message')

                @foreach($data as $kode=>$data_pembelian)
                    <p >Kode Pembelian : {{ $kode }} </p>
                    <form action="{{ url('ubah-pembelian/'.$kode) }}" method="post">
                        {{ csrf_field() }}
                        <table class="table table-bordered" border="1" style="margin-bottom: 10px">

                            @php($i=1)

                            <tbody>
                            <tr>
                                <td colspan="5"><a class="btn btn-success" href="{{ url('selipkan-pembelian/'.$kode.'/1') }}">Selipkan pembelian</a></td>
                                <td colspan="2">
                                    <a href="{{ url('hapus-pembelian/'.$kode) }}" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus data')"><i class="fa fa-eraser"></i> Hapus Pembelian</a>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>No</td>
                                <td style="width: 30px">Tanggal</td>
                                <td>Produk</td>
                                <td style="width: 30px">Kwantitas</td>
                                <td style="width: 150px">Harga</td>
                                <td>Jumlah Pajak</td>
                                <td>Total Bayar</td>
                                <td></td>
                             </tr>
                            @foreach($data_pembelian as $row)
                                <tr>
                                    <td><input type="hidden" name="id[]" value="{{ $row->id }}"></input>{{ $i++ }}</td>
                                    <td><input class="form-control" type="date" name="tgl_pembelian[]" value="{{ $row->tgl_pembelian }}"></td>
                                    <td>
                                        <select  class="form-control" name="product_id[]">
                                            @foreach($product as $data)
                                                <option value="{{ $data->id }}" @if($data->id==$row->product_id) selected @endif>{{ $data->nama_barang }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td> <input class="form-control" type="text" name="kwantitas[]" value="{{ $row->kwantitas }}"> <input type="hidden" name="kwantitas_lama[]" value="{{ $row->kwantitas }}"> </td>
                                    <td> <input class="form-control"  type="text" name="harga[]" value="{{ $row->harga }}"></td>
                                    <td> <input class="form-control"  type="hidden" name="status_pembayaran[]" value="{{ $row->status_pembayaran }}">{{ $row->jumlah_pajak }}</td>
                                    <td> {{ ($row->harga * $row->kwantitas)+$row->jumlah_pajak }} </td>
                                    <td> <a href="{{ url('hapus-item-pembelian/'. $row->id) }}" onclick="return confirm('Apakah anda akan menghapus data pembelian ...?')">Hapus Item Pembelian</a> </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        <button type="submit" class="btn btn-warning"><i class="fa fa-pen"></i> Simpan Perubahan</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop