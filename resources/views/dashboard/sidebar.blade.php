<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="#">
        {{-- <a class="nav-link" href="{{route('dashboard')}}"> --}}
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span></a>
    </li>

    {{-- <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
            aria-expanded="true" aria-controls="collapseUser">
            <i class="fas fa-fw fa-cog"></i>
            <span>User</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">User</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{in_Array($activeMenu,['user','otorisasi']) ? 'active':''}}">
        {{-- collapsed --}}
        <!-- {{dump($activeMenu)}} -->
        <a class="nav-link {{in_Array($activeMenu,['user','otorisasi']) ? '':'collapsed'}}" href="#" data-toggle="collapse" data-target="#collapseUser"
            aria-expanded="{{in_Array($activeMenu,['user','otorisasi']) ? 'true':''}}" aria-controls="collapseUser">
            <i class="fas fa-fw fa-cog"></i>
            <span>User</span>
        </a>
        <div id="collapseUser" class="collapse {{in_Array($activeMenu,['user','otorisasi']) ? 'show':''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item {{in_Array($activeMenu,['user']) ? 'active':''}}" href="#">User</a>
                {{-- <a class="collapse-item {{in_Array($activeMenu,['user']) ? 'active':''}}" href="{{route('user.index')}}">User</a> --}}
                {{-- <a class="collapse-item {{in_Array($activeMenu,['otorisasi']) ? 'active':''}}" href="{{route('transaction.index')}}">Otorisasi</a> --}}
                <a class="collapse-item {{in_Array($activeMenu,['otorisasi']) ? 'active':''}}" href="#">Otorisasi</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{in_Array($activeMenu,['product','transaction','sales']) ? 'active':''}}">
        {{-- collapsed --}}
        <a class="nav-link {{in_Array($activeMenu,['product','transaction','sales']) ? '':'collapsed'}}" href="#" data-toggle="collapse" data-target="#collapseProduct"
            aria-expanded="{{in_Array($activeMenu,['product','transaction','sales']) ? 'true':''}}" aria-controls="collapseProduct">
            <i class="fas fa-fw fa-cog"></i>
            <span>Transaksi</span>
        </a>
        <div id="collapseProduct" class="collapse {{in_Array($activeMenu,['product','transaction','sales']) ? 'show':''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item {{in_Array($activeMenu,['product']) ? 'active':''}}" href="{{route('trxReport')}}">Laporan Transaksi</a>
                {{-- <a class="collapse-item {{in_Array($activeMenu,['product']) ? 'active':''}}" href="{{route('product.index')}}">Produk</a> --}}
                <a class="collapse-item {{in_Array($activeMenu,['transaction']) ? 'active':''}}" href="">Voucer Game</a>
                {{-- <a class="collapse-item {{in_Array($activeMenu,['transaction']) ? 'active':''}}" href="{{route('transaction.index')}}">Transaksi</a> --}}
                <a class="collapse-item {{in_Array($activeMenu,['sales']) ? 'active':''}}" href="#">PLN Token</a>
                {{-- <a class="collapse-item {{in_Array($activeMenu,['sales']) ? 'active':''}}" href="{{route('sales.index')}}">Penjualan</a> --}}
            </div>
        </div>
    </li>
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
{{-- <div class="sidebar-heading">
    Front End
</div> --}}
    <!-- Nav Item - Pages Collapse Menu -->
     {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom FrontEnd:</h6>
                <a class="collapse-item" href="buttons.html">Landing Page</a>
                <a class="collapse-item" href="cards.html">Slide Project</a>
                <a class="collapse-item" href="cards.html">Step</a>
                <a class="collapse-item" href="cards.html">Motto</a>
                <a class="collapse-item" href="cards.html">Gallery</a>
            </div>
        </div>
    </li> --}}
   
    <!-- Nav Item - Logout -->
    <li class="nav-item">
        {{-- <a class="nav-link" href="{{route('logout')}}"> --}}
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> 

    <!-- Sidebar Message -->
    {{-- <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div> --}}

</ul>