@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Penjualan</h1>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Formulir Penjualan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <form action="{{ url('penjualan-store') }}" method="post">
                        <p> Kode Transaksi <input class="form-control" type="text" name="kode" value="{{ $kode }}" readonly></p>
                        <p>
                            Tanggal: <input class="form-control" type="date" name="tgl_penjualan">
                        </p>
                        @for($i=1; $i<=$range; $i++)
                            <div >
                                <p>
                                    Product: <select class="form-control" name="product_id[]">
                                        @foreach($product as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <p>
                                    Kwantitas: <input class="form-control" type="text" name="kwantitas[]">
                                </p>
                            </div>
                            <hr style="height: 1px; color: red; border-top: 1px solid">
                        @endfor
                        <p>
                            Status Pembayaran: <br>
                            <input type="radio" name="status_pembayaran" value="Cash"> Tunai <br>
                            <input type="radio" name="status_pembayaran" value="Kredit"> Kredit <br>
                        </p>
                        {{ csrf_field() }}
                        <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop