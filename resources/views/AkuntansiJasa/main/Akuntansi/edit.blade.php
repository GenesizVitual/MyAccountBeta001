@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Jurnal</h1>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Formulir Jurnal</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ url('updates-jurnal/'. $data->id) }}" method="post" enctype="multipart/form-data">
                        <p>Halaman ini untuk membuat data jurnal</p>
                        <h5>
                            Tanggal :
                            <input type="date" class="form-control" name="tgl_transaksi" value="{{ date('Y-m-d', strtotime($data->tgl_transaksi)) }}" required>
                        </h5>
                        <h5>
                            Kode :
                            <input type="text" class="form-control" name="kode" value="{{ $data->kode }}">
                        </h5>
                        <h5>
                            Keterangan Jurnal :
                            <textarea class="form-control" name="transaksi" required>{{ $data->transaksi }}</textarea>
                        </h5>
                        <h5>
                            Kategori Jurnal :
                            <input type="radio" name="kategori_jurnal" value="1" required @if($data->kategori_jurnal==1) checked @endif> Umum
                            <input type="radio" name="kategori_jurnal" value="2" required @if($data->kategori_jurnal==2) checked @endif> Penyesuian
                        </h5>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop