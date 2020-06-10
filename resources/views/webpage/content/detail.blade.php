@extends('webpage.main_page')

@section('content')
    <!-- Header -->

            <!-- Content -->
            <section >
                <header class="main">
                    <h1>{{ $data->nama_bisnis }}</h1>
                </header>
                @if(!empty($data->gambar))
                    <img src="{{ asset('bisnis/'.$data->gambar ) }}" alt="" style="width: 100%" />
                @else
                    <img src="https://www.pngitem.com/pimgs/m/20-202034_restaurant-icon-vector-icon-restaurant-logo-png-transparent.png" alt="" style="width: 100%"/>
                @endif
                <p></p>

                <small>Lokasi :
                    {{ $data->alamat }},
                    {{ $data->negara }},
                    {{ $data->kota }},
                    {{ $data->kab }}.</small>
                <hr>
                <h1>Daftar Menu</h1>
                <div class="row">

                 @foreach($data->LinkToProduk as $produk)
                        <article>
                        <a href="#" class="image">
                            @if(!empty($produk->gambar))
                                <img src="{{ asset('produk/'.$produk->gambar ) }}" alt="" style="height: 60px; width: 100px" />
                            @else
                                <img src="https://c8.alamy.com/comp/PTCGH0/food-not-allowed-icon-design-vector-PTCGH0.jpg" alt="" style="height: 60px; width: 100px"/>
                            @endif
                        </a>
                        <h3>{{ $produk->nama_barang }}</h3>
                        <p>
                            <small>
                                <ul>
                                    <li>Unit: {{ $produk->satuan }}</li>
                                    <li>Harga: {{ number_format($produk->harga,2,',','.') }}</li>
                                    <li>Stok: {{ number_format($produk->stok,2,',','.') }}</li>
                                </ul>
                            </small>
                        </p>
                     </article>
                @endforeach
                </div>
            </section>

@stop