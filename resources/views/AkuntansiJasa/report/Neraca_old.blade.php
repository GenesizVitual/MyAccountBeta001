<h1>{{ $judul }}</h1>
<ul>

    @foreach($data as $lv1s=> $new_data)
        @php($total = 0)
            <li>{{ $lv1s }}
                <ul>
                    @foreach($new_data as $key=> $list)
                        <label style="font-weight: bold"> {{ $key }}</label>
                        @if(!empty($list['data']))
                            <ul>
                                @foreach($list['data'] as $data)
                                    <li >
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
                                <li>
                                    <table>
                                        <tr>
                                            <td width="300px" style="font-weight: bold">Total Kotor {{ $key }}</td>
                                            <td> :{{ $list['total'] }}</td>
                                            @php($total+=$list['total'])
                                        </tr>
                                    </table>
                                </li>
                            </ul>
                        @else
                            <label style="margin-left: 24%">:{{ $list }}</label>
                        @endif
                    @endforeach
                </ul>
            </li>
            <li>
                Total {{ $lv1s }} : {{ $total }}
            </li>
    @endforeach
</ul>