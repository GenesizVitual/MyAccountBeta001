@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Produk</h1>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Formulir Produk</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ url('update-produk/'.$data->id) }}" method="post" enctype="multipart/form-data">
                        <p>Halaman ini untuk mengubah data produk baru di outlate anda</p>
                        <h5>
                            Nama produk :
                            <input type="text" class="form-control" name="nama_barang" value="{{ $data->nama_barang }}" required>
                        </h5>
                        <h5>
                            Gambar : {{ $data->gambar  }}
                            <input type="file" class="form-control" name="gambar" required >
                        </h5>
                        <h5>
                            Satuan :
                            <input type="text" class="form-control" name="satuan" value="{{ $data->satuan }}" required>
                        </h5>
                        <h5>
                            Harga Jual :
                            <input type="text" class="form-control" name="harga"  value="{{ $data->harga }}" required>
                        </h5>
                        <h5>
                            Stok :
                            <input type="text" class="form-control" name="stok" value="{{ $data->stok }}"  required>
                        </h5>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop