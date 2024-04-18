@extends('layouts.master')
@section('page_title', 'Edit Standar Nulai')
@section('content')

    <div class="card">
        @include('layouts.notification')
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Edit Standar Nulai</h6>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('score.update', $score->id) }}">
                        @csrf @method('PATCH')
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">Nilai Minimal<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="number" name="number" class="form-control" min="0" max="100" placeholder="Penilaian Minimum Dalam Angka" value="{{ $score->number }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">Nilai Maksimal<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="number" name="max" class="form-control" min="1" max="100" placeholder="Penilaian Maksimum Dalam Angka" value="{{ $score->max }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">Dalam Huruf<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="letter" class="form-control" type="text" placeholder="Penilaian dalam huruf" value="{{ $score->letter }}" required>
                            </div>
                        </div>


                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--Class Edit Ends--}}

@endsection
