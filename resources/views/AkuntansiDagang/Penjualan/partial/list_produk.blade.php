<div class="container_pembelian_{{$data->id}}">
    <p>
        <input type="hidden" name="product_id[]" value="{{ $data->id }}">
        <input type="hidden" name="kwantitas_lama[]" value="{{ $data->stok }}">
        Product: <input class="form-control" name="nama_produk" value="{{ $data->nama_barang}}" readonly/>
    </p>
    <p>
        Kwantitas: <input class="form-control" type="number" max="{{$data->stok}}" name="kwantitas[]" value="{{ $data->stok }}">
    </p>
    <p class="pull-left">
        <a href="#" class="btn btn-sm btn-danger" onclick="remove_order({{ $data->id }})"><i class="fa fa-eraser"></i> Batalkan pesanan</a>
    </p>
    <hr>
</div>