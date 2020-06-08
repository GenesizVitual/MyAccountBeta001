@extends('webpage.main_page')

@section('content')
            <!-- Banner -->

            <section>
                <header class="major">
                    <h2>Kuliner</h2>
                </header>
                <div class="posts">
                    @foreach($kuliner as $data_kuliner)
                        <article>
                            <a href="#" class="image">
                                @if(!empty($data_kuliner->getImage))
                                    <img src="{{ asset('foto/'.$data_kuliner->getImage->image ) }}" alt="" />
                                @else
                                    <img src="{{ asset('FrontEnd/images/pic01.jpg') }}" alt="" />
                                @endif
                            </a>
                            <h3>{{ $data_kuliner->judul }}</h3>
                            <p>
                                {!! str_limit($data_kuliner->keterangan,200) !!}
                            </p>
                            <ul class="actions">
                                <li><a href="{{ url('detail-kuliner/'. $data_kuliner->id.'/kuliner') }}" class="button">More</a></li>
                            </ul>
                        </article>
                    @endforeach
                </div>
            </section>
@endsection