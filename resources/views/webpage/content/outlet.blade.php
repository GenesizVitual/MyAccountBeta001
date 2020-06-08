@extends('webpage.main_page')

@section('content')
    <!-- Header -->
    <div id="main">
        <div class="inner">

            <!-- Content -->
              <section class="gallery-block grid-gallery">

                  <div class="row">
                      <div class="col-md-12">
                          <h2>Outlate kami</h2>
                      </div>

                      <div class="col-md-12">
                          <h5>Tulis Disini Paragraf</h5>
                      </div>
                      <div class="col-md-12">
                          <div id="mapid" style="width: 100%; height: 500px"></div>
                      </div>
                  </div>
              </section>
            <section>
                <header class="major">
                    <h2>Outlate</h2>
                </header>
                <div class="posts">
                    @foreach($data as $data_bussines)
                        <article>
                            <a href="#" class="image">
                                @if(!empty($data_bussines->gambar))
                                    <img src="{{ asset('bisnis/'.$data_bussines->gambar ) }}" style="width: 300px; height: 210px" alt="" />
                                @else
                                    <img src="https://www.pngitem.com/pimgs/m/20-202034_restaurant-icon-vector-icon-restaurant-logo-png-transparent.png" style="width: 300px;height: 210px" alt="" />
                                @endif
                            </a>
                            <h2>{{ $data_bussines->nama_bisnis }}</h2>
                            <span style="font-weight: bold">
                               Lokasi :
                                    {{ $data_bussines->alamat }},
                                    {{ $data_bussines->negara }},
                                    {{ $data_bussines->kota }},
                                    {{ $data_bussines->kab }}.
                            </span>
                            <span>

                            </span>
                            <ul class="actions">
                                <li><a href="{{ url('detail-outlate/'. $data_bussines->id) }}" class="button">More</a></li>
                            </ul>
                        </article>
                    @endforeach
                </div>
            </section>
        </div>
    </div>


@stop