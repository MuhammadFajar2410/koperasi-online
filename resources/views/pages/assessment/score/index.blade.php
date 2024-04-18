@extends('layouts.master')
@section('page_title', 'Standar Nilai')
@section('content')

    <div class="card">
        @include('layouts.notification')
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Standar Nilai</h6>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Standar Nilai</a></li>
                <li class="nav-item"><a href="#new-class" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i>Tambah Standar Baru</a></li>
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-classes">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nilai Minimal dalam Angka</th>
                                    <th>Nilai Maksimal dalam Angka</th>
                                    <th>Nilai dalam Huruf</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($scores)
                                    @foreach ($scores as $score )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $score->number }}</td>
                                            <td>{{ $score->max }}</td>
                                            <td>{{ $score->letter }}</td>
                                            <td class="text-center">
                                                <div class="list-icons">
                                                    <div class="dropdown">
                                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-left">

                                                            <a href="{{ route('score.edit', $score->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>

                                                            <a id="{{ $score->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                            <form method="POST" id="item-delete-{{ $score->id }}" action="{{ route('score.destroy', $score->id) }}" class="hidden">@csrf @method('delete')</form>

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

                <div class="tab-pane fade" id="new-class">
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('score.add') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Nilai Minimal<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="number" value="{{ old('number') }}" type="number" class="form-control" placeholder="Penilaian Minimum Dalam Angka" min="0" max="100">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Nilai Maksimal<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="max" value="{{ old('max') }}" type="number" class="form-control" placeholder="Penilaian Maksimum Dalam Angka" min="1" max="100">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Dalam Huruf<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="letter" value="{{ old('letter') }}" type="text" class="form-control" placeholder="Penilaian Dalam Huruf">
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
        </div>
    </div>

    {{--TimeTable Ends--}}

@endsection
