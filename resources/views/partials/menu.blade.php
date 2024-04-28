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



                <!--Academics-->
                {{-- @php
                    $user_role = User::with('roles')
                @endphp --}}
                @if(Auth::user() && (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'ketua' || Auth::user()->role->name == 'pengurus'))
                    {{-- <li class="nav-item {{ in_array(Route::currentRouteName(), ['classroom.index']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="{{ route('classroom.index') }}" class="nav-link"><i class="icon-windows2"></i> <span>Kelas</span></a>
                    </li> --}}

                    <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['role.index', 'user.index', 'add.user.view', 'member.index']) ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link"><i class="icon-windows2"></i><span>Manajemen Anggota</span></a>
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
                    <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['primary.index', 'secondary.index']) ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link"><i class="icon-windows2"></i><span>Transaksi</span></a>
                        <ul class="nav nav-group-sub">
                            <li class="nav-item">
                                <a href="{{ route('primary.index') }}" class="nav-link
                                {{ (Route::is('primary.index')) ? 'active' : ''}}">Transaksi Simpanan Pokok</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('secondary.index') }}" class="nav-link
                                {{ (Route::is('secondary.index')) ? 'active' : ''}}">Transaksi Simpanan Sukarela</a>
                            </li>
                        </ul>
                    </li>
                @endif
                    <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.index', 'students.add.index']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="javascript:void(0)" class="nav-link"><i class="icon-users"></i> <span>Kesiswaan</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                            {{--Admit Student--}}
                            @if(Auth::user() && (Auth::user()->role == 'admin' || Auth::user()->role == 'guru' || Auth::user()->role == 'kepala_sekolah'))
                                <li class="nav-item">
                                    <a href="{{ url('students.add.index') }}"
                                       class="nav-link {{ (Route::is('students.add.index')) ? 'active' : '' }}">Tambah Siswa Baru</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('students.index') }}"
                                       class="nav-link {{ (Route::is('students.index')) ? 'active' : '' }}">Data Siswa</a>
                                </li>
                            @endif
                            {{--Student Information--}}
                            {{-- <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.list', 'students.edit', 'students.show']) ? 'nav-item-expanded' : '' }}">
                                <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['students.list', 'students.edit', 'students.show']) ? 'active' : '' }}">Student Information</a>
                                <ul class="nav nav-group-sub">
                                    @foreach(App\Models\MyClass::orderBy('name')->get() as $c)
                                        <li class="nav-item"><a href="{{ route('students.list', $c->id) }}" class="nav-link ">{{ $c->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li> --}}

                        </ul>
                    </li>

                {{-- @if(Qs::userIsTeamSA()) --}}
                    {{--Manage Users--}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['users.index', 'users.show', 'users.edit']) ? 'active' : '' }}"><i class="icon-users4"></i> <span> Users</span></a>
                    </li> --}}

                    {{--Manage Classes--}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('classes.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['classes.index','classes.edit']) ? 'active' : '' }}"><i class="icon-windows2"></i> <span> Classes</span></a>
                    </li> --}}

                    {{--Manage Dorms--}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('dorms.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['dorms.index','dorms.edit']) ? 'active' : '' }}"><i class="icon-home9"></i> <span> Dormitories</span></a>
                    </li> --}}

                    {{--Manage Sections--}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('sections.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['sections.index','sections.edit',]) ? 'active' : '' }}"><i class="icon-fence"></i> <span>Sections</span></a>
                    </li> --}}

                    {{--Manage Subjects--}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('subjects.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['subjects.index','subjects.edit',]) ? 'active' : '' }}"><i class="icon-pin"></i> <span>Subjects</span></a>
                    </li>
                @endif --}}

                {{--Exam--}}

                {{-- @if(Qs::userIsTeamSAT())
                <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['exams.index', 'exams.edit', 'grades.index', 'grades.edit', 'marks.index', 'marks.manage', 'marks.bulk', 'marks.tabulation', 'marks.show', 'marks.batch_fix',]) ? 'nav-item-expanded nav-item-open' : '' }} ">
                    <a href="#" class="nav-link"><i class="icon-books"></i> <span> Exams</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Manage Exams">
                        @if(Qs::userIsTeamSA()) --}}

                        {{--Exam list--}}
                            {{-- <li class="nav-item">
                                <a href="{{ route('exams.index') }}"
                                   class="nav-link {{ (Route::is('exams.index')) ? 'active' : '' }}">Exam List</a>
                            </li> --}}

                            {{--Grades list--}}
                            {{-- <li class="nav-item">
                                    <a href="{{ route('grades.index') }}"
                                       class="nav-link {{ in_array(Route::currentRouteName(), ['grades.index', 'grades.edit']) ? 'active' : '' }}">Grades</a>
                            </li> --}}

                            {{--Tabulation Sheet--}}
                            {{-- <li class="nav-item">
                                <a href="{{ route('marks.tabulation') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.tabulation']) ? 'active' : '' }}">Tabulation Sheet</a>
                            </li> --}}

                            {{--Marks Batch Fix--}}
                            {{-- <li class="nav-item">
                                <a href="{{ route('marks.batch_fix') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.batch_fix']) ? 'active' : '' }}">Batch Fix</a>
                            </li>
                        @endif --}}

                        {{-- @if(Qs::userIsTeamSAT()) --}}
                            {{--Marks Manage--}}
                            {{-- <li class="nav-item">
                                <a href="{{ route('marks.index') }}"
                                   class="nav-link {{ in_array(Route::currentRouteName(), ['marks.index']) ? 'active' : '' }}">Marks</a>
                            </li> --}}

                            {{--Marksheet--}}
                            {{-- <li class="nav-item">
                                <a href="{{ route('marks.bulk') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.bulk', 'marks.show']) ? 'active' : '' }}">Marksheet</a>
                            </li>

                            @endif

                    </ul>
                </li>
                @endif --}}


                {{--End Exam--}}

                {{-- @include('pages.'.Qs::getUserType().'.menu') --}}

                {{--Manage Account--}}
                {{-- <li class="nav-item">
                    <a href="{{ route('my_account') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['my_account']) ? 'active' : '' }}"><i class="icon-user"></i> <span>My Account</span></a>
                </li> --}}

                </ul>
            </div>
        </div>
</div>
