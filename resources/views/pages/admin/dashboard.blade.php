@extends('layouts.master')
@section('page_title', 'My Dashboard')

@section('content')
<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-indigo-400 has-bg-image">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <i class="icon-cash3 icon-3x opacity-75"></i>
                </div>

                <div class="media-body text-right">
                    <h3 class="mb-0">{{ 'Rp. ' . number_format($current_amount, 0, ',', '.') }}</h3>
                    <span class="text-uppercase font-size-xs">Saldo Terbaru</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-blue-400 has-bg-image">
            <div class="media">
                <div class="media-body">
                    <h3 class="mb-0">{{ App\Models\User::getUserRole('anggota')->count() }}</h3>
                    <span class="text-uppercase font-size-xs font-weight-bold">Total Anggota</span>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-users4 icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-danger-400 has-bg-image">
            <div class="media">
                <div class="media-body">
                    <h3 class="mb-0">{{ App\Models\User::getUserRole('pengurus')->count() }}</h3>
                    <span class="text-uppercase font-size-xs">Total Pengurus</span>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-users2 icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-success-400 has-bg-image">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <i class="icon-pointer icon-3x opacity-75"></i>
                </div>

                <div class="media-body text-right">
                    <h3 class="mb-0">{{ App\Models\User::getUserRole('admin')->count() }}</h3>
                    <span class="text-uppercase font-size-xs">Total Administrators</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div id="chart">
                {!! $chart->container() !!}
            </div>
        </div>
    </div>
</div>
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}

@endsection
