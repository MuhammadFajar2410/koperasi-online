@extends('layouts.master')
@section('page_title', 'Semua Anggota')
@section('content')

    <div class="card">
        @include('layouts.notification')
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Semua Anggota</h6>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Anggota</a></li>
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-classes">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Anggota</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jnis kelamis</th>
                                <th>Pekerjaan</th>
                                <th>Status</th>
                                <th>Tanggal Bergabung</th>
                                <th>Tanggal Keluar</th>
                                <th>Alasan</th>
                                <th>Aksi</th>
                                {{-- <th>Status</th> --}}
                            </tr>
                            </thead>
                            <tbody>
                        @if ($profiles)
                            @foreach($profiles as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->member_id ?? 'Belum Ada' }}</td>
                                    <td>{{ $p->name ?? '' }}</td>
                                    <td>{{ Str::limit($p->address ?? '', $limit = 10, $end = '...') }}</td>
                                    <td>{{ $p->gender == 'l' ? 'L' : 'P' }}</td>
                                    <td>{{ $p->job ?? '' }}</td>
                                    <td>{{ $p->user->status ? 'Aktif' : 'Non Aktif' }}</td>
                                    <td>{{ $p->user->joinOn ?? '' }}</td>
                                    <td>{{ $p->user->exitOn ?? '' }}</td>
                                    <td>{{ $p->reason ?? '' }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">


                                                    {{-- <a href="{{ route('users.edit', $u->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a> --}}


                                                    {{-- <a id="{{ $u->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                    <form method="POST" id="item-delete-{{ $u->id }}" action="{{ route('users.destroy', $u->id) }}" class="hidden">@csrf @method('delete')</form> --}}

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                            </tbody>
                        </table>
                    </div>

                <div class="tab-pane fade" id="new-class">
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--TimeTable Ends--}}

@endsection
