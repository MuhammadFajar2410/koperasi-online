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
                                    <td>
                                        @foreach ($primary as $pr )
                                            @if ($p->user->id == $pr->user_id)
                                                {{ $pr->id }}
                                            @endif
                                        @endforeach
                                    </td>
                                    {{-- @foreach ($primary as $pr)
                                        @if ($p->user->id == $pr->user_id)
                                            <td>{{ $pr->id }}</td>
                                        @else
                                            <td>Tidak ada simpanan pokok</td>
                                        @endif
                                    @endforeach --}}
                                    <td class="text-center">
                                        @foreach ($primary as $pr )
                                            @if ($p->user->id == $pr->user_id)
                                                <div class="list-icons">
                                                    <div class="dropdown">
                                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-left">
                                                            <a href="{{ route('primary.show', $pr->id) }}" class="dropdown-item"><i class="icon-eye"></i> Simpanan Pokok</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
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
