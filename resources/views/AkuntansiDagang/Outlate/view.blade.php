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
                @include('message')
                <p>Halaman ini akan menampilkan data profil tentang outlate anda</p>
                <h4>Nama Outlate: {{ $data->nama_bisnis }}</h4>
                <h5>Alamat :{{ $data->alamat }}</h5>
                <div class="row">
                    <div class="col-md-12">
                        @if(!empty($data->gambar))
                            <img src="{{ asset('bisnis/'.$data->gambar) }}" style="width: 100%; margin: 0px" alt="Gambar Belum diupload"/>
                        @else
                            <img src="https://c8.alamy.com/comp/PTCGH0/food-not-allowed-icon-design-vector-PTCGH0.jpg" style="width: 100%; margin: 0px" alt="Gambar Belum diupload"/>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop