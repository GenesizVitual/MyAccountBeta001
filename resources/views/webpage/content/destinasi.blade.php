@extends('webpage.main_page')

@section('content')
            <!-- Banner -->

            <section>
                <header class="major">
                    <h2>Destinasi</h2>
                </header>
                <div class="posts">
                    @foreach($destinasi as $data_destinasi)
                        <article>
                            <a href="#" class="image">
                                @if(!empty($data_destinasi->getImage))
                                    <img src="{{ asset('foto/'.$data_destinasi->getImage->image ) }}" alt="" />
                                @else
                                    <img src="{{ asset('FrontEnd/images/pic01.jpg') }}" alt="" />
                                @endif
                            </a>
                            <h3>{{ $data_destinasi->judul }}</h3>
                            <p>
                                {!! str_limit($data_destinasi->keterangan,200) !!}
                            </p>
                            <ul class="actions">
                                <li><a href="{{ url('detail-destinasi/'. $data_destinasi->id.'/destinasi') }}" class="button">More</a></li>
                            </ul>
                        </article>
                    @endforeach
                </div>
            </section>
@endsection