@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"></h1>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Akun Transaksi</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ url('store-akun-transaksi') }}" method="post" enctype="multipart/form-data">
                        <p>Halaman ini untuk membuat data akun transaksi</p>
                        <h5>
                            Akun :
                            <select class="form-control" name="akun_id" required>
                                @foreach($akun as $data)
                                    <option value="{{ $data->id }}">{{ $data->kode }} - {{ $data->akun_lv2 }}</option>
                                @endforeach
                            </select>
                        </h5>
                        <h5>
                            Kode :
                            <input type="text" class="form-control" name="kode" required>
                        </h5>
                        <h5>
                            Nama Akun Transaksi :
                            <input type="text" class="form-control" name="akun_lv3" required>
                        </h5>
                        <h5>
                            Buku Besar :
                            <select class="form-control" name="buku_besar_id" required>
                                @foreach($buku_besar as $data)
                                    <option value="{{ $data->id }}">{{ $data->kode }} - {{ $data->akun_lv1 }}</option>
                                @endforeach
                            </select>
                        </h5>
                        <h5>
                            Saldo Normal :
                            <input type="radio" name="posisi_akun" value="1" required checked> Debit
                            <input type="radio" name="posisi_akun" value="2" required> Kredit
                        </h5>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop