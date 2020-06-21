@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Pengaturan Akun Transaksi</h1>

<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Akun Transaksi</h6>
                <div class="dropdown no-arrow">
                    <a href="{{ url('akun-transaksi') }}" class="btn btn-primary" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus fa-sm fa-fw text-gray-400"></i> Tambah Akun
                    </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Halaman ini akan menampilkan seluruh yang tersedia</p>
                @include('message');
                <ul>
                @foreach($data as $akun)
                    <li style="color: green">{{ $akun->kode }} - {{ $akun->akun_lv2 }}
                        <ul>
                            @foreach($akun->LinkToAkunJurnalTransaksi->sortBy('kode') as $akun_transaksi)

                             <li>
                                <p>{{ $akun_transaksi->kode }} - {{ $akun_transaksi->akun_lv3	 }}
                                    <a href="{{ url('ubah-akun-transaksi/'. $akun_transaksi->id) }}" class="btn btn-warning btn-sm pull-right"><i class="fa fa-pen"></i></a>
                                    <a href="{{ url('delete-akun-transaksi/'. $akun_transaksi->id) }}" class="btn btn-danger btn-sm pull-right" onclick="return confirm('Apakah anda akan menghapus akun ini ...?')"><i class="fa fa-eraser"></i></a>
                                </p>
                             </li>
                             @endforeach
                        </ul>
                    </li>
                @endforeach
                </ul>

            </div>
        </div>
    </div>
</div>
@stop