@extends('layouts.master')
@section('page_title', 'Riwayat Transaksi')
@section('content')

    <div class="card">
        @include('layouts.notification')
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Riwayat Transaksi</h6>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Riwayat</a></li>
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-classes">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Transaksi</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                        @if ($transactions)
                            @foreach($transactions as $t)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $t->transaction_type }}</td>
                                    <td class="text-primary">{{ $t->type == 'd' ? 'Rp. ' . number_format($t->amount, 0, ',', '.') : '' }}</td>
                                    <td class="text-danger">{{ $t->type == 'c' ? 'Rp. ' . number_format($t->amount, 0, ',', '.') : '' }}</td>
                                    <td>{{ $t->description }}</td>
                                    <td>{{ $t->date }}</td>
                                    {{-- <td>{{ $t->created_by_user }}</td> --}}
                                    <td>
                                        @foreach ($profiles as $profile)
                                            @if ($profile->id == $t->created_by_user)
                                                {{ $profile->profile->name ?? '-'}}
                                            @endif
                                        @endforeach
                                    </td>

                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">


                                                    {{-- <a href="{{ route('secondary.show', $s->id) }}" class="dropdown-item"><i class="icon-eye"></i> Detail</a> --}}


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
            </div>
        </div>
    </div>

    {{--TimeTable Ends--}}

@endsection
