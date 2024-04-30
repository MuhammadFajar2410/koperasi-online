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
                        <form action="{{ route('loan.update', $profile->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label font-weight-semibold" for="type">Transaksi<span class="text-danger">*</span></label>
                                <div class="col-lg-3">
                                    <select class="select-search form-control" id="type" name="type" data-fouc data-placeholder="Choose.." required>
                                        <option value=""></option>
                                        <option value="d">Debit</option>
                                        <option value="c">Kredit</option>

                                    </select>
                                </div>
                                <label class="col-form-label font-weight-semibold">Nominal<span class="text-danger">*</span></label>
                                <div class="col-lg-3">
                                    <input type="number" name="amount" class="form-control" placeholder="Nominal" min="1" required>
                                </div>
                                <label class="col-form-label font-weight-semibold">Keterangan<span class="text-danger">*</span></label>
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" name="description" placeholder="Keterangan Koreksi Wajib Diisi" required>
                                </div>
                                <button class="btn btn-primary col-1">Save</button>
                            </div>
                        </form>
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                                <th>Sisa</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Dibuat Oleh</th>
                            </tr>
                            </thead>
                            <tbody>
                        @if ($loans)

                            @foreach($loans as $l)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-primary">{{ $l->type == 'd' ? 'Rp. ' . number_format($l->amount, 0, ',', '.') : '' }}</td>
                                    <td class="text-danger">{{ $l->type == 'c' ? 'Rp. ' . number_format($l->amount, 0, ',', '.') : '' }}</td>
                                    <td>{{ 'Rp. ' . number_format($l->latest_amount, 0, ',', '.') }}</td>
                                    <td>{{ $l->date }}</td>
                                    <td>{{ $l->description ?? '' }}</td>
                                    <td>
                                        @foreach ($profiles as $profile)
                                            @if ($profile->id == $l->created_by)
                                                {{ $profile->profile->name ?? '-'}}
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
