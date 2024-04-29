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
                <li class="nav-item"><a href="#menabung" class="nav-link" data-toggle="tab"> Pinjaman</a></li>
                <li class="nav-item"><a href="#menarik" class="nav-link" data-toggle="tab"> Pembayaran</a></li>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                        @if ($loans)
                            @foreach($loans as $l)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $l->user->profile->member_id }}</td>
                                    <td>{{ $l->user->profile->name }}</td>
                                    <td>{{ 'Rp. ' . number_format($l->loan_amount, 0, ',', '.') }}</td>
                                    <td>{{ $l->loan_interest . '%' }}</td>
                                    <td>{{ 'Rp. ' . number_format($l->total_amount, 0, ',', '.') }}</td>
                                    <td>{{ $l->period }}</td>
                                    <td>{{ 'Rp. ' . number_format($l->remaining_loan, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">


                                                    <a href="{{ route('primary.show', $l->id) }}" class="dropdown-item"><i class="icon-eye"></i> Detail</a>


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

                    <div class="tab-pane fade" id="menabung">
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('loan.add') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Nama Anggota <span class="text-danger">*</span></label>
                                        <select class="select-search form-control" id="user_id" name="user_id" data-fouc data-placeholder="Choose..">
                                            <option value=""></option>
                                            @foreach ($profiles as $p )
                                                <option value="{{ $p->id }}">{{ $p->profile->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Nominal Pinjaman <span class="text-danger">*</span></label>
                                        <input type="number" name="amount" class="form-control" min="1" required>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Jasa Pinjaman dalam persentase <span class="text-danger">*</span></label>
                                        <input type="number" name="interest" class="form-control" min="0" max="100" required>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Periode Pinjaman <span class="text-danger">*</span></label>
                                        <input type="text" name="period" class="form-control" required>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Keterangan <span class="text-danger"></span></label>
                                        <input type="text" name="description" class="form-control">
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="menarik">
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('loan.installment') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Nama Anggota <span class="text-danger">*</span></label>
                                        <select class="select-search form-control" id="user_id" name="user_id" data-fouc data-placeholder="Choose..">
                                            <option value=""></option>
                                            @foreach ($allProfiles as $p )
                                                <option value="{{ $p->id }}">{{ $p->profile->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Nominal Pinjaman <span class="text-danger">*</span></label>
                                        <input type="number" name="amount" class="form-control" min="1" required>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Jasa Pinjaman dalam persentase <span class="text-danger">*</span></label>
                                        <input type="number" name="loan_interest" class="form-control" min="0" max="100" required>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Tanggal Pinjaman <span class="text-danger">*</span></label>
                                        <input type="date" name="date" class="form-control" required>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Keterangan <span class="text-danger"></span></label>
                                        <input type="text" name="description" class="form-control">
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    {{--TimeTable Ends--}}

@endsection
