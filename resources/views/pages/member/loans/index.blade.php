@extends('layouts.master')
@section('page_title', 'Transaksi Pinjaman')
@section('content')

    <div class="card">
        @include('layouts.notification')
        <div class="card-header header-elements-inline">
            <h6 class="card-title"></h6>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <h5>Nama : <span class="font-weight-bold">{{ $profile->user->profile->name }}</span></h5>
            <h5>Total Pinjaman :
                <span class="font-weight-bold {{ $profile->remaining_loan <= 0 ? 'bg-success' : '' }}">
                    @if($profile)
                        {{ 'Rp. ' . number_format($profile->total_amount, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </span>
            </h5>
            <h5>Sisa Pinjaman :
                <span class="font-weight-bold {{ $profile->remaining_loan <= 0 ? 'bg-success' : '' }}">
                    @if($profile)
                        {{ 'Rp. ' . number_format($profile->remaining_loan, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </span>
            </h5>
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">List Transaksi</a></li>
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-classes">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nominal</th>
                                <th>Transaksi</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Dibuat Oleh</th>
                                {{-- <th>Status</th> --}}
                            </tr>
                            </thead>
                            <tbody>
                        @if ($loans)

                            @foreach($loans as $l)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ 'Rp. ' . number_format($l->amount, 0, ',', '.') }}</td>
                                    <td class="{{ $l->type == 'd' ? 'text-primary' : 'text-danger' }}">{{ $l->type == 'd' ? 'Debit' : 'Kredit' }}</td>
                                    <td>{{ $l->date }}</td>
                                    <td>{{ $l->description ?? '' }}</td>
                                    <td>{{ $l->created_by }}</td>
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
