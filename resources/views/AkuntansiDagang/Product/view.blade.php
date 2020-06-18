@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Produk</h1>

<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
                <div class="dropdown no-arrow">
                    <a href="{{ url('tambah-produk') }}" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus fa-sm fa-fw text-gray-400"></i>
                    </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Halaman ini akan menampilkan seluruh produk yang ada dioutlet anda</p>
                @include('message')
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Nama Satuan</th>
                            <th>Nama Harga Jual</th>
                            <th>Nama Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php($no=1)
                        @foreach($data as $list)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td >
                                    @if(!empty($list->gambar))
                                        <img src="{{ asset('produk/'.$list->gambar) }}" style="width: 110px; margin: 0px" alt="Gambar Belum diupload"/>
                                    @else
                                        <img src="https://c8.alamy.com/comp/PTCGH0/food-not-allowed-icon-design-vector-PTCGH0.jpg" style="width: 110px; margin: 0px" alt="Gambar Belum diupload"/>
                                    @endif
                                </td>
                                <td>{{ $list->nama_barang }}</td>
                                <td>{{ $list->satuan }}</td>
                                <td>{{ $list->harga }}</td>
                                <td>{{ $list->stok }}</td>
                                <td>
                                    <form action="{{ url('delete-produk/'.$list->id) }}" method="post">
                                        <a href="{{ url('ubah-produk/'. $list->id) }}" class="btn btn-warning" onclick="return confirm('Apakah anda akan menghubah produk ini ...?')"><i class="fa fa-pen"></i></a>
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus produk ini ...?')"><i class="fa fa-eraser"></i></button>
                                        {{ csrf_field() }}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop