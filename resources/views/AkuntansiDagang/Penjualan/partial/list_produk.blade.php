<div class="container_pembelian">
    <p>
        <input type="hidden" name="product_id[]" value="{{ $data->id }}">
        <input type="hidden" name="kwantitas_lama[]" value="{{ $data->stok }}">
        Product: <input class="form-control" name="nama_produk" value="{{ $data->nama_barang}}" readonly/>
    </p>
    <p>
        Kwantitas: <input class="form-control" type="text" name="kwantitas[]" value="{{ $data->stok }}">
    </p>
    <hr>
</div>