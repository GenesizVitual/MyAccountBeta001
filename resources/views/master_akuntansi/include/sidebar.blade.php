<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin<sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('outlate') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Outlate</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{ url('daftar-produk') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Produk</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Akuntansi</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pembelian/Penjualan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('data-pembelian') }}">Pembelian</a>
                <a class="collapse-item" href="{{ url('data-penjualan') }}">Penjualan</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Daftar Laporan:</h6>
                <a class="collapse-item" href="{{ url('laporan-pembelian') }}">Pembelian</a>
                <a class="collapse-item" href="{{ url('laporan-penjualan') }}">Penjualan</a>
                <a class="collapse-item" href="{{ url('buku-besar') }}">Buku Besar</a>
                <a class="collapse-item" href="{{ url('neraca-saldo') }}">Neraca Saldo</a>
                <a class="collapse-item" href="{{ url('laba-rugi') }}">Laba Rugi</a>
                <a class="collapse-item" href="{{ url('neraca') }}">Neraca</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">



</ul>