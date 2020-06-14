@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Karyawan</h1>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Formulir Karyawan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="{{ url('update-karyawan/'.$data->id) }}" method="post" enctype="multipart/form-data">
                        <p>Halaman ini untuk menambah data karyawan baru di outlate anda</p>
                        <h5>
                            Nama :
                            <input type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                        </h5>
                        <h5>
                            Email :
                            <input type="email" class="form-control" name="email" value="{{ $data->email }}" required>
                        </h5>
                        <h5>
                            Password :
                            <input type="password" class="form-control" name="password" required>
                        </h5>
                        <h5>
                            Level:
                            <select class="form-control" name="level" required>
                                <option>Pilih level karyawan</option>
                                <option value="0" @if($data->level==0) selected @endif> Superadmin </option>
                                <option value="1" @if($data->level==1) selected @endif> Kasir </option>
                            </select>
                        </h5>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop