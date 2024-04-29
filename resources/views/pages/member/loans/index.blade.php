@extends('layouts.master')
@section('page_title', 'Pinjaman')
@section('content')

    <div class="card">
        @include('layouts.notification')
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Pinjaman Anggota</h6>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">List Transaksi</a></li>
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-classes">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Anggota</th>
                                    <th>Nama</th>
                                    <th>Pinjaman</th>
                                    <th>Jasa</th>
                                    <th>Total</th>
                                    <th>Periode</th>
                                    <th>Sisa</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                        @if ($loans)
                            @foreach($loans as $l)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $l->user->profile->member_id ?? 'Belum ada' }}</td>
                                    <td>{{ $l->user->profile->name }}</td>
                                    <td>{{ 'Rp. ' . number_format($l->loan_amount, 0, ',', '.') }}</td>
                                    <td>{{ $l->loan_interest . '%' }}</td>
                                    <td>{{ 'Rp. ' . number_format($l->total_amount, 0, ',', '.') }}</td>
                                    <td>{{ $l->period }}</td>
                                    <td>{{ 'Rp. ' . number_format($l->remaining_loan, 0, ',', '.') }}</td>
                                    <td class="{{ $l->remaining_loan <= 0 ? 'bg-success' : 'bg-danger' }}">{{ $l->remaining_loan <= 0 ? 'Lunas' : 'Belum Lunas' }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">


                                                    <a href="{{ route('loan.member.show', $l->id) }}" class="dropdown-item"><i class="icon-eye"></i> Detail</a>


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
