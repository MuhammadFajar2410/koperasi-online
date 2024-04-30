<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
    Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        {{-- <a href="{{ route('my_account') }}"><img src="{{ Auth::user()->photo }}" width="38" height="38" class="rounded-circle" alt="photo"></a> --}}
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{ Auth::user()->profile->name }}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-user font-size-sm"></i> &nbsp;{{ ucwords(str_replace('_', ' ', Auth::user()->role->name ?? '')) }}
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="{{ url('my_account') }}" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ (Route::is('dashboard')) ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                {{-- Class --}}



                <!--Users-->
                @if(Auth::user() && (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'ketua' || Auth::user()->role->name == 'pengurus'))
                    <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['role.index', 'user.index', 'add.user.view', 'member.index']) ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link"><i class="icon-person"></i><span>Manajemen Anggota</span></a>
                        <ul class="nav nav-group-sub">
                            @if(Auth::user() && (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'ketua'))
                                <li class="nav-item">
                                    <a href="{{ route('role.index') }}" class="nav-link
                                    {{ (Route::is('role.index')) ? 'active' : ''}}">Jabatan</a>
                                </li>
                                <li class="nav-item">
                                 <a href="{{ route('user.index') }}" class="nav-link
                                    {{ (Route::is('user.index')) ? 'active' : ''}}">Users</a>
                                </li>
                            @endif
                                <li class="nav-item">
                                    <a href="{{ route('add.user.view') }}" class="nav-link
                                    {{ (Route::is('add.user.view')) ? 'active' : ''}}">Anggota Baru</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('member.index') }}" class="nav-link
                                    {{ (Route::is('member.index')) ? 'active' : ''}}">Semua Anggota</a>
                                </li>
                        </ul>
                    </li>
                @endif
                    <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['primary.index', 'secondary.index', 'primary.member.index', 'secondary.member.index']) ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link"><i class="icon-windows2"></i><span>Transaksi</span></a>
                        <ul class="nav nav-group-sub">
                            @if(Auth::user() && (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'ketua' || Auth::user()->role->name == 'pengurus' ))
                                <li class="nav-item">
                                    <a href="{{ route('primary.index') }}" class="nav-link
                                    {{ (Route::is('primary.index')) ? 'active' : ''}}">Transaksi Simpanan Pokok</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('secondary.index') }}" class="nav-link
                                    {{ (Route::is('secondary.index')) ? 'active' : ''}}">Transaksi Simpanan Sukarela</a>
                                </li>
                            @endif
                                <li class="nav-item">
                                    <a href="{{ route('primary.member.index') }}" class="nav-link
                                    {{ (Route::is('primary.member.index')) ? 'active' : ''}}">Simpanan Pokok</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('secondary.member.index') }}" class="nav-link
                                    {{ (Route::is('secondary.member.index')) ? 'active' : ''}}">Simpanan Sukarela</a>
                                </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['loan.index', 'loan.member.index']) ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link"><i class="icon-book3"></i><span>Pinjaman</span></a>
                        <ul class="nav nav-group-sub">
                            @if(Auth::user() && (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'ketua' || Auth::user()->role->name == 'pengurus' ))
                                <li class="nav-item">
                                    <a href="{{ route('loan.index') }}" class="nav-link
                                    {{ (Route::is('loan.index')) ? 'active' : ''}}">Pinjaman Anggota</a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a href="{{ route('loan.member.index') }}" class="nav-link
                                    {{ (Route::is('loan.member.index')) ? 'active' : ''}}">Pinjaman</a>
                                </li>
                        </ul>
                    </li>
                    @if(Auth::user() && (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'ketua' || Auth::user()->role->name == 'pengurus'))
                    <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['other.cat.index', 'other.transaction.index']) ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link"><i class="icon-windows2"></i><span>Transaksi Lainnya</span></a>
                        <ul class="nav nav-group-sub">
                                <li class="nav-item">
                                    <a href="{{ route('other.cat.index') }}" class="nav-link
                                    {{ (Route::is('other.cat.index')) ? 'active' : ''}}">Kategori Transaksi Lainnya</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('other.transaction.index') }}" class="nav-link
                                    {{ (Route::is('other.transaction.index')) ? 'active' : ''}}">Transaksi Lainnya</a>
                                </li>

                        </ul>
                    </li>
                @endif
                </ul>
            </div>
        </div>
</div>
