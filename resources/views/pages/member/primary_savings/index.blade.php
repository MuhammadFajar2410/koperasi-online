@extends('layouts.master')
@section('page_title', 'Simpanan Pokok ')
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
            <h5>Nama : <span class="font-weight-bold">{{ Auth::user()->profile->name }}</span></h5>
            <h5>Saldo :
                <span class="font-weight-bold">
                    @if($profile)
                        {{ 'Rp. ' . number_format($profile->amount, 0, ',', '.') }}
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
                                <th>Debit</th>
                                <th>Kredit</th>
                                <th>Saldo</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Dibuat Oleh</th>
                                {{-- <th>Status</th> --}}
                            </tr>
                            </thead>
                            <tbody>
                        @if ($savings)

                            @foreach($savings as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-primary">{{ $s->type == 'd' ? 'Rp. ' . number_format($s->amount, 0, ',', '.') : '' }}</td>
                                    <td class="text-danger">{{ $s->type == 'c' ? 'Rp. ' . number_format($s->amount, 0, ',', '.') : '' }}</td>
                                    <td>{{ 'Rp. ' . number_format($s->latest_amount, 0, ',', '.') }}</td>
                                    <td>{{ $s->date }}</td>
                                    <td>{{ $s->description ?? '' }}</td>
                                    <td>{{ $s->created_by }}</td>
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
