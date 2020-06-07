@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Outlate</h1>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Profile Outlate</h6>
                    <div class="dropdown no-arrow">
                        <a href="{{ url('ubah-outlate/'.$data->id) }}" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-pen fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ url('update-outlate/'. $data->id) }}" method="post">
                        <p>Halaman ini untuk mengubah data profil tentang outlate anda</p>
                        <h5>
                            Nama Bisnis :
                            <input class="form-control" name="nama_bisnis" value="{{ $data->nama_bisnis }}">
                        </h5>
                        <h5>Alamat :
                            <textarea class="form-control" name="alamat">{{ $data->alamat }}</textarea>
                        </h5>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop