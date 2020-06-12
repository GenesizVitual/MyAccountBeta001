@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Laporan Stok</h1>

<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Stok</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Halaman ini akan menampilkan seluruh Data stok yg tersedia dioutlet anda</p>
                <form action="{{ url('print-stok') }}" method="post" target="_blank">
                    <div class="row">
                        <div class="col-3">
                            Tanggal Awal
                            <input class="form-control" type="date" name="tgl_awal" required>
                        </div>
                        <div class="col-3">
                            Tanggal Akhir
                            <input class="form-control" type="date" name="tgl_akhir" required>
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-success" style="margin-top: 10%"><i class="fa fa-print"></i> Print</button>
                        </div>
                        {{ csrf_field() }}
                    </div>
                </form>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr style="background-color: lawngreen">
                        <td>No</td>
                        <td>Produk</td>
                        <td>Tanggal</td>
                        <td>Stok</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($data))
                        @foreach($data as $data_list)
                            <tr>
                                <td>{{ $data_list['no'] }}</td>
                                <td colspan="2">{{ $data_list['nama_barang'] }}</td>
                                <td></td>
                            </tr>
                            @if(!empty($data_list['sub_data']))
                                @foreach($data_list['sub_data'] as $data_sub)
                                    <tr>
                                        <td colspan="2"></td>
                                        <td>{{ date('d-m-Y', strtotime($data_sub['tgl'])) }}</td>
                                        <td>{{ $data_sub['sisa_stok'] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop