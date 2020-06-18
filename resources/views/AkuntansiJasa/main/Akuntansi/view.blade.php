@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Akuntansi</h1>

<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Jurnal</h6>
                <div class="dropdown no-arrow">
                    <a href="{{ url('jurnal') }}" class="btn btn-primary" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus fa-sm fa-fw text-gray-400"></i> Tambah Jurnal
                    </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Halaman ini akan menampilkan seluruh jurnal yang ada dioutlet anda</p>
                @include('message')
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <td style="width: 10px">Nomor Urut</td>
                        <td>Tanggal</td>
                        <td style="width: 30px">Kode Transaksi/Kode Perkiraan</td>
                        <td>Keterangan</td>
                        <td>Debet</td>
                        <td>Kredit</td>
                        <td>Aksi</td>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($data['data_jurnal'] as $jurnalUmum)
                        <tr style="background-color: greenyellow">
                            <td>{{ $jurnalUmum['no'] }}</td>
                            <td>{{ date('d-m-Y', strtotime($jurnalUmum['tanggal_transaksi'])) }}</td>
                            <td>{{ $jurnalUmum['kode'] }}</td>
                            <td colspan="3">{{ $jurnalUmum['jurnal'] }}</td>
                            <td><a href="#" class="btn btn-sm btn-primary">Tambah Akun</a>
                                <a href="{{ url('detail-jurnal/'.$jurnalUmum['id_jurnal']) }}" class="btn btn-sm btn-primary">Lihat Jurnal</a></td>
                        </tr>
                        @if(!empty($jurnalUmum['data']))
                            @foreach($jurnalUmum['data'] as $data_akun)
                                <tr>
                                    <td colspan="2"></td>
                                    <td>{{ $data_akun['kode_akun'] }}</td>
                                    <td>{{ $data_akun['akun'] }}</td>
                                    <td>{{ number_format($data_akun['jum_debet'],2,',','.') }}</td>
                                    <td>{{ number_format($data_akun['jum_kredit'],2,',','.') }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr style="background-color: greenyellow">
                        <td colspan="4" style="text-align: center">Total</td>
                        <td >{{ number_format($data['total_debet'],2,',','.') }}</td>
                        <td >{{ number_format($data['total_kredit'],2,',','.') }}</td>
                        <td > </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@stop