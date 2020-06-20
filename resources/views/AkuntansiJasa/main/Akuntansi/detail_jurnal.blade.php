@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Jurnal</h1>

<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ $data_jurnal->transaksi }}</h6>
                <div class="dropdown no-arrow">
                    <a href="{{ url('detail-jurnal/'.$id_jurnal.'/create') }}" class="btn btn-primary" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus fa-sm fa-fw text-gray-400"></i> Tambah Akun
                    </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Halaman ini akan menampilkan seluruh akun yang berkaitan dengan jurnal yang ada dioutlet anda</p>
                @include('message')
                @if($proses != 'default' )
                <form action="{{ url('store-akun/'.$id_jurnal) }}" method="post">
                    <p>
                        Akun:
                        <select class="form-control" name="akun_transaksi_id">
                            @foreach($data_akuns as $akun)
                                <optgroup label="{{ $akun->akun_lv2 }} - {{ $akun->posisi_saldo }}">
                                    @foreach($akun->LinkToAkunJurnalTransaksi as $akun_transaksi )
                                        <option value="{{ $akun_transaksi->id }}" >  {{ $akun_transaksi->akun_lv3 }} - {{ $akun_transaksi->posisi_akun }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </p>
                    <p>
                        Debet:
                        <input name="jum_debet" type="text" class="form-control" value="0">
                    </p>
                    <p>
                        Kredit:
                        <input name="jum_kredit" type="text" class="form-control" value="0">
                    </p>
                    {{ csrf_field() }}
                    <button class="btn btn-success"><i class="fa fa-plus"></i> Simpan akun </button>
                </form>
                <p></p>
                <h1 style="height: 1px; border-top: 3px solid; color: darkgray"></h1>
                <p></p>
                @endif
                <form action="{{ url('update-jurnal/'.$id_jurnal) }}" method="post">
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
                                <td></td>
                            </tr>
                            @if(!empty($jurnalUmum['data']))
                                @foreach($jurnalUmum['data'] as $data_akun)
                                    <tr>
                                        <td colspan="2"></td>
                                        <td>{{ $data_akun['kode_akun'] }}</td>
                                        <td>
                                            <input type="hidden" name="akun_id[]" value="{{ $data_akun['akun_id'] }}">
                                            <select class="form-control" name="akun_transaksi_id[]">
                                               @foreach($data_akuns as $akun)
                                                    <optgroup label="{{ $akun->akun_lv2 }} - {{ $akun->posisi_saldo }}">
                                                        @foreach($akun->LinkToAkunJurnalTransaksi as $akun_transaksi )
                                                            <option value="{{ $akun_transaksi->id }}" @if($akun_transaksi->id == $data_akun['akun_transaksi_id']) selected @endif >  {{ $akun_transaksi->akun_lv3 }} - {{ $akun_transaksi->posisi_akun }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="width:100px;">
                                            <input name="jum_debet[]" type="text" class="form-control" value="{{ number_format($data_akun['jum_debet'],0,'','') }}">
                                        </td>
                                        <td style="width:100px;">
                                            <input name="jum_kredit[]" type="text" class="form-control" value="{{ number_format($data_akun['jum_kredit'],0,'','') }}">
                                        </td>
                                        <td>
                                            <form action="{{ url('delete-akun/'.$data_akun['akun_id']) }}" method="post">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger" onclick="confirm('apakah anda akan menghapus akun ini ...?')"><i class="fa fa-eraser"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr style="background-color: greenyellow">
                            <td colspan="4" style="text-align: center">Total</td>
                            <td >{{ number_format($data['total_debet'],0,'','') }}</td>
                            <td >{{ number_format($data['total_kredit'],0,'','') }}</td>
                            <td ></td>
                        </tr>
                        </tfoot>
                    </table>
                    <p>
                        {{ csrf_field() }}
                        <button class="btn btn-primary"><i class="fa fa-pen"></i> Ubah akun</button> <label style="font-weight: bold; color: red">*Jumlah total debet dan kredit harus sama</label>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@stop