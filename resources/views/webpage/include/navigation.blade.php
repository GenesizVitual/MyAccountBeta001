<div id="sidebar">
    <div class="inner">

        <!-- Search -->
        <section id="search" class="alt">
            <h1> Resto Kendari </h1>
        </section>

        <!-- Menu -->
        <nav id="menu">
            <header class="major">
                <h2>Menu</h2>
            </header>
            <ul>
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ url('rumah-makan') }}">Outlet</a></li>
                {{--<li><a href="{{ url('tentang') }}">Tentang</a></li>--}}
                <li>
                        @if(!empty(Session::get('user_id')))
                            <a href="#">Anda Telah Login</a>
                        @else
                            <a href="{{ url('login') }}">Login</a>
                        @endif
                </li>
            </ul>
        </nav>

    </div>
</div>