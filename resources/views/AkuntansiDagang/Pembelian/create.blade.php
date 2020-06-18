@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Pembelian</h1>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pembelian</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ url('pembelian-store') }}" method="post">
                        <p> Kode Transaksi <input class="form-control" type="text" name="kode" value="{{ $kode }}" readonly></p>
                        <p>
                            Tanggal: <input class="form-control" type="date" name="tgl_pembelian" required>
                        </p>
                        @for($i=1; $i<=$range; $i++)
                            <div >
                                <p>
                                    Product:
                                    <select class="form-control" name="product_id[]">
                                        @foreach($product as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <p>
                                    Kwantitas: <input class="form-control" type="text" name="kwantitas[]">
                                </p>
                                <p>
                                    Harga: <input class="form-control" type="text" name="harga[]">
                                </p>
                            </div>
                            <hr style="color: red; height: 1px; border-top: 1px solid">
                        @endfor
                        <p>
                            Status Pembayaran: <br>
                            <input type="radio" name="status_pembayaran" value="Cash" required> Tunai <br>
                            <input type="radio" name="status_pembayaran" value="Kredit" required> Kredit <br>
                        </p>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success" onclick="return confirm('Pastikan data pembelian anda sudah benar')">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop