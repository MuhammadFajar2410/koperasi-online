@extends('layouts.master')
@section('page_title', 'Transaksi Lainnya')
@section('content')

    <div class="card">
        @include('layouts.notification')
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Transaksi Lainnya</h6>
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
                <li class="nav-item"><a href="#menabung" class="nav-link" data-toggle="tab"> Transaksi Lainnya</a></li>
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-classes">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Kategori</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    <th>Dibuat Oleh</th>
                                </tr>
                            </thead>
                            <tbody>
                        @if ($transactions)
                            @foreach($transactions as $t)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-primary">{{ $t->type == 'd' ? 'Rp. ' . number_format($t->amount, 0, ',', '.') : '' }}</td>
                                    <td class="text-danger">{{ $t->type == 'c' ? 'Rp. ' . number_format($t->amount, 0, ',', '.') : '' }}</td>
                                    <td>{{ $t->transaction_category->name }}</td>
                                    <td>{{ $t->description }}</td>
                                    <td>{{ $t->date }}</td>
                                    {{-- Menampilkan nama pembuat --}}
                                    <td>
                                        @foreach ($profiles as $profile)
                                            @if ($profile->id == $t->created_by)
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

                    <div class="tab-pane fade" id="menabung">
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('other.transaction.add') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Kategori <span class="text-danger">*</span></label>
                                        <select class="select-search form-control" id="t_cat_id" name="t_cat_id" data-fouc data-placeholder="Choose..">
                                            <option value=""></option>
                                            @foreach ($categories as $c )
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Keterangan Transaksi  <span class="text-danger">*</span></label>
                                        <input type="text" name="description" class="form-control" placeholder="Contoh : Saldo awal tahun 2024" required>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Nominal <span class="text-danger">*</span></label>
                                        <input type="number" name="amount" class="form-control" min="1" placeholder="Nominal Transaksi" required>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Tipe Transaksi <span class="text-danger">*</span></label>
                                        <select name="type" id="type" class="select-search form-control">
                                            <option value="d">Debit</option>
                                            <option value="c">Kredit</option>
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Tanggal Transaksi <span class="text-danger">*</span></label>
                                        <input type="date" name="date" class="form-control" required>
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
