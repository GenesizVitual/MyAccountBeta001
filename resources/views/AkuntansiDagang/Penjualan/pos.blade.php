@extends('master_akuntansi.base')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">POS</h1>

    <div class="row">
        <div class="col-xl-4 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Struk</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <form action="{{ url('penjualan-store') }}" method="post" id="preview_form">
                        <p> Kode Transaksi <input class="form-control" type="text" name="kode" value="{{ $kode }}" readonly></p>
                        <p>
                            Tanggal: <input class="form-control" type="text" name="tgl_penjualan" value="{{ $tanggal }}" readonly />
                        </p>
                        <div id="container_pembelian">
                            {{--<p>--}}
                               {{--Product: <select class="form-control" name="product_id[]" id="produk_{{ $i }}">--}}
                                        {{--@foreach($product as $data)--}}
                                            {{--<option value="{{ $data->id }}" @if($data->stok == 0) disabled @endif>{{ $data->nama_barang }}</option>--}}
                                        {{--@endforeach--}}
                               {{--</select>--}}
                            {{--</p>--}}
                            {{--<p>--}}
                               {{--Kwantitas: <input class="form-control" type="text" name="kwantitas[]" id="kwantitas_{{ $i }}">--}}
                            {{--</p>--}}
                       </div>
                        <p>
                            Status Pembayaran: <br>
                            <input type="radio" name="status_pembayaran" value="Cash" required> Tunai <br>
                            <input type="radio" name="status_pembayaran" value="Kredit" required> Kredit <br>
                        </p>
                        {{ csrf_field() }}
                        <button class="btn btn-primary" type="button" id="prev"><i class="fa fa-eye"></i> Lihat </button>
                        <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <a href="{{ url('data-penjualan') }}" class="btn btn-primary">Daftar Penjualan</a>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row" style="overflow: scroll; height: 500px">
                        @foreach($product as $data)
                                <div class="col-sm-3">
                                    <button class="btn btn-success" id="add_product_{{ $data->id }}" @if($data->stok == 0) onclick="return confirm('Stok telah habis, silahkan menambahkan stok terlebih dahulu')" @else onclick="get_product('{{ $data->id }}')" @endif style="text-align: center;height: 200px">
                                        <p style="text-align: center">
                                            @if(!empty($data->gambar))
                                                <img src="{{ asset('produk/'.$data->gambar) }}" style="width: 100%; height: 100%;">
                                            @else
                                                <img src="data:image/png;base64,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" style="width: 100%">
                                            @endif
                                            <small>Produk : {{ $data->nama_barang }}</small> <br>
                                            <small>Harga : {{ number_format($data->harga,2,',','.') }}</small> <br>
                                            <small>Stok : {{ $data->stok }}</small>
                                        </p>
                                    </button>
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-penjualan" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title">Tabel Penjualan</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="table-responsive" style="padding-top: 1%">
                            <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produk</th>
                                    <th>kwantitas</th>
                                    <th>harga</th>
                                    <th>Sub Total</th>
                               </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <h4 id="total" style="text-align: center;background-color: cornsilk"></h4>
                            <h4 id="total_pajak" style="text-align: center;background-color: cornsilk"></h4>
                            <h5 id="total_keseluruhan" style="text-align: center;background-color: cornsilk"></h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function () {

            table_penerimaan = $('#example1').DataTable({
                data:[],
                column:[
                    {'data' :'0'},
                    {'data' :'1'},
                    {'data' :'2'},
                    {'data' :'3'},
                ],
                rowCallback : function(row, data){

                },
                filter: false,
                pagging : true,
                searching: true,
                info : true,
                ordering : true,
                processing : true,
                retrieve: true
            });


            $('#prev').click(function () {
                var datastring = $("#preview_form").serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('prev') }}",
                    data: datastring,
                }).done(function(data){
                    console.log(data);
                    $('#modal-penjualan').modal('show');
                    $('#total').text("Sub total :"+data.sub_total);
                    $('#total_pajak').text("Pajak :"+data.total_pajak);
                    $('#total_keseluruhan').text("Total Keseluruhan :"+data.total_keseluruhan);
                    table_penerimaan.clear().draw();
                    table_penerimaan.rows.add(data.data).draw();
                });
            });

            get_product =function (product) {
                $.ajax({
                    url: '{{ url('list-produk') }}',
                    type : "POST",
                    data:{
                        '_token':'{{ csrf_token() }}',
                        'id_produk' : product
                    },
                    success: function(result){
                        $('#add_product_'+product).prop('disabled', true);
                        $('#container_pembelian').append(result);
                    }
                })
            }

            remove_order = function (product) {
               $('#add_product_'+product).prop('disabled', false);
               $('.container_pembelian_'+product).remove();
            }

        })
    </script>
@stop