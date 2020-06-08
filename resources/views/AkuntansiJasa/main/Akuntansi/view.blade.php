@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Akuntansi</h1>

<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Jurnal</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Halaman ini akan menampilkan seluruh jurnal yang ada dioutlet anda</p>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <td>Nomor Urut</td>
                        <td>Tanggal</td>
                        <td>Kode Transaksi/Kode Perkiraan</td>
                        <td>Keterangan</td>
                        <td>Debet</td>
                        <td>Kredit</td>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($data['data_jurnal'] as $jurnalUmum)
                        <tr style="background-color: greenyellow">
                            <td>{{ $jurnalUmum['no'] }}</td>
                            <td>{{ $jurnalUmum['tanggal_transaksi'] }}</td>
                            <td>{{ $jurnalUmum['kode'] }}</td>
                            <td colspan="3">{{ $jurnalUmum['jurnal'] }}</td>
                        </tr>
                        @foreach($jurnalUmum['data'] as $data_akun)
                            <tr>
                                <td colspan="2"></td>
                                <td>{{ $data_akun['kode_akun'] }}</td>
                                <td>{{ $data_akun['akun'] }}</td>
                                <td>{{ $data_akun['jum_debet'] }}</td>
                                <td>{{ $data_akun['jum_kredit'] }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr style="background-color: greenyellow">
                        <td colspan="4" style="text-align: center">Total</td>
                        <td >{{ $data['total_debet'] }}</td>
                        <td >{{ $data['total_kredit'] }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@stop