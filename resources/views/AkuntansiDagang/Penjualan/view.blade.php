@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Penjualan</h1>

    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Penjualan</h6>
                    <div class="dropdown no-arrow">
                        <a href="{{ url('tambah-penjualan/5') }}" class="btn btn-primary" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-plus fa-sm fa-fw text-gray-400"></i> Penjualan
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    @foreach($data as $kode=>$data_penjualan)
                        <p >Kode Penjualan : {{ $kode }} </p>
                        <form  action="{{ url('ubah-penjualan/'.$kode) }}" method="post">
                            {{ csrf_field() }}
                            <table  class="table table-bordered"  border="1" style="margin-bottom: 10px">

                                @php($i=1)

                                <tbody>
                                <tr>
                                    <td colspan="5"><a class="btn btn-success"  href="{{ url('selipkan-penjualan/'.$kode.'/1') }}"><i class="fa fa-book"></i> Selipkan Penjualan</a> <a class="btn btn-success"  href="{{ url('selipkan-penjualan-pos/'.$kode) }}"><i class="fa fa-archive"></i> Selipkan Penjualan (Mode POS)</a></td>
                                    <td colspan="2">
                                        <a href="{{ url('hapus-penjualan/'.$kode) }}" class="btn btn-danger"  onclick="return confirm('Apakah anda akan menghapus data')"><i class="fa fa-eraser"></i> Hapus Penjualan</a>
                                        <a href="{{ url('cetak-penjualan/'.$kode) }}" class="btn btn-primary" ><i class="fa fa-print"></i> Cetak</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>No</td>
                                    <td style="width: 30px">Tanggal</td>
                                    <td>Produk</td>
                                    <td style="width: 30px">Kwantitas</td>
                                    <td style="width: 150px">Harga Jual</td>
                                    <td>Jumlah Pajak</td>
                                    <td></td>
                                </tr>
                                @foreach($data_penjualan as $row)
                                    <tr>
                                        <td><input class="form-control" type="hidden" name="id[]" value="{{ $row->id }}"></input>{{ $i++ }}</td>
                                        <td><input class="form-control" type="date" name="tgl_penjualan[]" value="{{ $row->tgl_penjualan }}"></td>
                                        <td>
                                            <select class="form-control" name="product_id[]">
                                                @foreach($product as $data)
                                                    <option value="{{ $data->id }}" @if($data->id==$row->product_id) selected @endif>{{ $data->nama_barang }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td> <input class="form-control" type="text" name="kwantitas[]" value="{{ $row->kwantitas }}"> <input type="hidden" name="kwantitas_lama[]" value="{{ $row->kwantitas }}"></td>
                                        <td> <input class="form-control" type="text" name="harga[]" value="{{ $row->harga }}" readonly></td>
                                        <td> <input class="form-control" type="hidden" name="status_pembayaran[]" value="{{ $row->status_pembayaran }}">{{ $row->jumlah_pajak }}</td>
                                        <td> <a href="{{ url('hapus-item-penjualan/'. $row->id) }}" onclick="return confirm('Apakah anda akan menghapus data pembelian ...?')">Hapus Item Penjualan</a> </td>
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