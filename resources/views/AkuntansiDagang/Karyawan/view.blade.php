@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Karyawan</h1>

<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Karyawan</h6>
                <div class="dropdown no-arrow">
                    <a href="{{ url('tambah-karyawan') }}" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus fa-sm fa-fw text-gray-400"></i> <i class="fa fa-user"></i>
                    </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Halaman ini akan menampilkan seluruh karyawan yang ada dioutlet anda</p>
                @include('message')
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php($no=1)
                        @foreach($data as $list)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td >
                                    {{ $list->name }}
                                </td>
                                <td>{{ $list->email }}</td>
                                <td>Password bersifat rahasia</td>
                                <td>
                                    @if($list->level==1)
                                        Karyawan
                                    @else
                                        Superadmin
                                    @endif

                                </td>
                                <td>
                                    <form action="{{ url('delete-karyawan/'.$list->id) }}" method="post">
                                        <a href="{{ url('ubah-karyawan/'. $list->id) }}" class="btn btn-warning" onclick="return confirm('Apakah anda akan menghubah karyawan ini ...?')"><i class="fa fa-pen"></i></a>
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda akan menghapus produk ini ...?')"><i class="fa fa-eraser"></i></button>
                                        {{ csrf_field() }}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop