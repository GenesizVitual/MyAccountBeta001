@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Laporan {{ $judul }}</h1>

<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tabel {{ $judul }}</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Halaman ini akan menampilkan seluruh Data {{ $judul }} dioutlet anda</p>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr style="background-color: lawngreen">
                        <td>No</td>
                        <td>Tanggal</td>
                        <td>Produk</td>
                        <td>Kwantitas</td>
                        <td>Harga</td>
                        <td>Total</td>
                        <td>Pajak</td>
                        <td>Status Pembayara</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($data))
                        @foreach($data as $data_list)
                            <tr>
                                <td>{{ $data_list['no'] }}</td>
                                <td>{{ date('d-m-Y', strtotime($data_list['tgl'])) }}</td>
                                <td>{{ $data_list['product'] }}</td>
                                <td>{{ $data_list['kwantitas'] }}</td>
                                <td>{{ number_format($data_list['harga'],2,',','.') }}</td>
                                <td>{{ number_format($data_list['total'],2,',','.') }}</td>
                                <td>{{ number_format($data_list['pajak'],2,',','.') }}</td>
                                <td>{{ $data_list['status_pembayaran'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop