@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Laba Rugi</h1>

<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Laba Rugi</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Halaman ini akan menampilkan seluruh Akun Laba Rugi</p>

                <ul>
                    @foreach($data as $key=> $list)
                        <li>
                            <label style="font-weight: bold"> {{ $key }}</label>
                            @if(!empty($list['data']))
                                <ul>
                                    @foreach($list['data'] as $data)
                                        <li style="list-style:none">
                                            <table >
                                                <tr>
                                                    <td width="300px" style="font-weight: bold">
                                                        <label>{{ $data['nama_akun'] }}</label>
                                                    </td>
                                                    <td>
                                                        <label>:{{ $data['total_saldo'] }}</label>
                                                    </td>
                                                </tr>
                                            </table>
                                        </li>
                                    @endforeach
                                    <li style="list-style:none">
                                        <table>
                                            <tr>
                                                <td width="300px" style="font-weight: bold">Total Kotor {{ $key }}</td>
                                                <td> :{{ $list['total'] }}</td>
                                            </tr>
                                        </table>
                                    </li>
                                </ul>
                            @else
                                <label style="margin-left: 24%">:{{ $list }}</label>
                            @endif
                        </li>

                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@stop