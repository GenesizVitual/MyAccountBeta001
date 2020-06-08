@extends('webpage.main_page')

@section('content')
            <!-- Banner -->
            @php($i=0)
            @foreach($data as $data_berita)
            <section id="banner">

                <div class="content">
                    <header>
                        <h1>
                            @if($i == 0)
                                {{ $data_berita->judul }}
                            @else
                                {{ $i }}. {{ $data_berita->judul }}
                            @endif
                        </h1>
                    </header>
                    <p>{!! $data_berita->keterangan  !!} </p>

                </div>
            </section>
                @php($i++)
            @endforeach

            <!-- Section -->
            {{--<section>--}}
                {{--<header class="major">--}}
                    {{--<h2>Berita</h2>--}}
                {{--</header>--}}
                {{--<div class="posts">--}}
                    {{--@foreach($daftat_berita as $data_berita)--}}
                        {{--<article>--}}
                            {{--<a href="#" class="image">--}}
                                {{--@if(!empty($data_berita->getImage))--}}
                                    {{--<img src="{{ asset('foto/'.$data_berita->getImage->image ) }}" alt="" />--}}
                                {{--@else--}}
                                    {{--<img src="{{ asset('FrontEnd/images/pic01.jpg') }}" alt="" />--}}
                                {{--@endif--}}
                            {{--</a>--}}
                            {{--<h3>{{ $data_berita->judul }}</h3>--}}
                            {{--<p>--}}
                                {{--{!! str_limit($data_berita->keterangan,200) !!}--}}
                            {{--</p>--}}
                            {{--<ul class="actions">--}}
                                {{--<li><a href="{{ url('detail-berita/'. $data_berita->id.'/berita') }}" class="button">More</a></li>--}}
                            {{--</ul>--}}
                        {{--</article>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            {{--</section>--}}

            {{--<section>--}}
                {{--<header class="major">--}}
                    {{--<h2>Destinasi</h2>--}}
                {{--</header>--}}
                {{--<div class="posts">--}}
                    {{--@foreach($destinasi as $data_destinasi)--}}
                        {{--<article>--}}
                            {{--<a href="#" class="image">--}}
                                {{--@if(!empty($data_destinasi->getImage))--}}
                                    {{--<img src="{{ asset('foto/'.$data_destinasi->getImage->image ) }}" alt="" />--}}
                                {{--@else--}}
                                    {{--<img src="{{ asset('FrontEnd/images/pic01.jpg') }}" alt="" />--}}
                                {{--@endif--}}
                            {{--</a>--}}
                            {{--<h3>{{ $data_destinasi->judul }}</h3>--}}
                            {{--<p>--}}
                                {{--{!! str_limit($data_destinasi->keterangan,200) !!}--}}
                            {{--</p>--}}
                            {{--<ul class="actions">--}}
                                {{--<li><a href="{{ url('detail-destinasi/'. $data_destinasi->id.'/destinasi') }}" class="button">More</a></li>--}}
                            {{--</ul>--}}
                        {{--</article>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            {{--</section>--}}

            {{--<section>--}}
                {{--<header class="major">--}}
                    {{--<h2>Kuliner</h2>--}}
                {{--</header>--}}
                {{--<div class="posts">--}}
                    {{--@foreach($kuliner as $data_kuliner)--}}
                        {{--<article>--}}
                            {{--<a href="#" class="image">--}}
                                {{--@if(!empty($data_kuliner->getImage))--}}
                                    {{--<img src="{{ asset('foto/'.$data_kuliner->getImage->image ) }}" alt="" />--}}
                                {{--@else--}}
                                    {{--<img src="{{ asset('FrontEnd/images/pic01.jpg') }}" alt="" />--}}
                                {{--@endif--}}
                            {{--</a>--}}
                            {{--<h3>{{ $data_kuliner->judul }}</h3>--}}
                            {{--<p>--}}
                                {{--{!! str_limit($data_kuliner->keterangan,200) !!}--}}
                            {{--</p>--}}
                            {{--<ul class="actions">--}}
                                {{--<li><a href="{{ url('detail-kuliner/'. $data_kuliner->id.'/kuliner') }}" class="button">More</a></li>--}}
                            {{--</ul>--}}
                        {{--</article>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            {{--</section>--}}


@endsection