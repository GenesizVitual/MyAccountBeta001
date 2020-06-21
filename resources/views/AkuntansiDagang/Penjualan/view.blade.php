@extends('master_akuntansi.base')

@section('content')


    <div class="modal fade" id="modal-pembayaran" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title">Tabel Penjualan</h4>
                </div>
                <form action="{{ url('cetak-penjualan') }}" method="POST">
                    <div class="modal-body">
                        <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-success btn-lg" style="margin-top: 20px;width: 100%">
                                           Banyak Item: <label id="item_count"></label>
                                        </button>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-lg" style="margin-top: 20px;width: 100%">
                                            Grand Total: <label id="total_count"></label>
                                            <input type="hidden" class="btn btn-danger btn-lg" id="grand_total">
                                        </button>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 20px; width: 100%">
                                        <input type="hidden" class="btn btn-danger btn-lg" id="kode" name="kode">
                                        <input type="number" class="form-control" id="uang" name="uang" placeholder="Total Pembayaran">
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-danger btn-lg" style="margin-top: 20px;width: 100%">
                                            Kembalian: <label id="kembalian_count"></label>
                                        </button>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary pull-right">Bayar</button>
                    </div>
                 </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <h1 class="h3 mb-4 text-gray-800">Penjualan </h1>

    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Penjualan Terbaru</h6>
                    <div class="dropdown no-arrow">
                        <a href="{{ url('tambah-penjualan/5') }}" class="btn btn-primary" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-plus fa-sm fa-fw text-gray-400"></i> Penjualan
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    @include('message')
                    @foreach($data as $kode=>$data_penjualan)
                        <p >Kode Penjualan : {{ $kode }} </p>
                        <form  action="{{ url('ubah-penjualan/'.$kode) }}" method="post">
                            {{ csrf_field() }}
                            <table  class="table table-bordered"  border="1" style="margin-bottom: 10px">

                                @php($i=1)

                                <tbody>
                                <tr>
                                    <td colspan="5"><a class="btn btn-success"  href="{{ url('selipkan-penjualan/'.$kode.'/1') }}"><i class="fa fa-book"></i> Selipkan Penjualan</a> <a class="btn btn-success"  href="{{ url('selipkan-penjualan-pos/'.$kode) }}" target="_blank"><i class="fa fa-archive"></i> Selipkan Penjualan (Mode POS)</a></td>
                                    <td colspan="2">
                                        <a href="{{ url('hapus-penjualan/'.$kode) }}" class="btn btn-danger"  onclick="return confirm('Apakah anda akan menghapus data')"><i class="fa fa-eraser"></i> Hapus Penjualan</a>
                                        <a href="#" class="btn btn-primary" onclick="jumlah_bayar('{{$kode}}')"><i class="fa fa-print"></i> Bayar</a>
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
                                        <td> <input class="form-control" type="text" name="harga[]" value="{{ number_format($row->harga,2,',','.') }}" readonly></td>
                                        <td> <input class="form-control" type="hidden" name="status_pembayaran[]" value="{{ $row->status_pembayaran }}">{{ number_format($row->jumlah_pajak,2,',','.') }}</td>
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
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Penjualan Lengkap</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="collapseCardExample" style="">
                    <div class="card-body">
                        @foreach($model_lama as $kode=>$data_penjualan)
                            <p >Kode Penjualan : {{ $kode }} </p>
                            <form  action="{{ url('ubah-penjualan/'.$kode) }}" method="post">
                                {{ csrf_field() }}
                                <table  class="table table-bordered"  border="1" style="margin-bottom: 10px">

                                    @php($i=1)

                                    <tbody>
                                    <tr>
                                        <td colspan="5"><a class="btn btn-success"  href="{{ url('selipkan-penjualan/'.$kode.'/1') }}"><i class="fa fa-book"></i> Selipkan Penjualan</a> <a class="btn btn-success"  href="{{ url('selipkan-penjualan-pos/'.$kode) }}" target="_blank"><i class="fa fa-archive"></i> Selipkan Penjualan (Mode POS)</a></td>
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
                                            <td> <input class="form-control" type="text" name="harga[]" value="{{ number_format($row->harga,2,',','.') }}" readonly></td>
                                            <td> <input class="form-control" type="hidden" name="status_pembayaran[]" value="{{ $row->status_pembayaran }}">{{ number_format($row->jumlah_pajak,2,',','.') }}</td>
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

    </div>
@stop


@section('js')
    <script>
        $(document).ready(function () {

            jumlah_bayar = function (kode) {
                $.ajax({
                    url:"{{ url('lihat-penjualan') }}/"+kode,
                    type: "get",
                    success: function(result){
                        console.log(result);
                        $('#item_count').text(result.banyak_barang);
                        $('#kode').val(kode);
                        $('#total_count').text(result.total_bayar);
                        $('#grand_total').val(result.total_bayar);
                        $('#modal-pembayaran').modal('show');
                    }
                });
            }

            $('#uang').on('input',function () {
                var grand_total = $('#grand_total').val();
                $('#kembalian_count').text($(this).val() - grand_total);
            })
        })
    </script>
@stop