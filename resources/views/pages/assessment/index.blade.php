@extends('layouts.master')
@section('page_title', 'Mata Pelajaran dan Penilaian')
@section('content')

    <div class="card">
        @include('layouts.notification')
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Mata Pelajaran dan Penilaian</h6>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Mapel</a></li>
                <li class="nav-item"><a href="#new-class" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i>Tambah Penilaian Baru</a></li>
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-classes">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mapel/Penilaian</th>
                                    <th>Tipe</th>
                                    <th>Minimum KKM</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($assessment)
                                    @foreach ($assessment as $ass )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ass->name }}</td>
                                            <td>{{ $ass->type }}</td>
                                            <td>{{ $ass->minimum }}</td>
                                            <td>{{ $ass->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                                            <td class="text-center">
                                                <div class="list-icons">
                                                    <div class="dropdown">
                                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-left">

                                                            <a href="{{ route('assessment.edit', $ass->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>

                                                            <a id="{{ $ass->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                            <form method="POST" id="item-delete-{{ $ass->id }}" action="{{ route('assessment.destroy', $ass->id) }}" class="hidden">@csrf @method('delete')</form>
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
                            <form method="POST" action="{{ route('assessment.add') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Tipe<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select class="select-search form-control" id="type" name="type" data-fouc data-placeholder="Choose..">
                                            @foreach ($type as $key=>$value )
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Nama Penilaian<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="name" value="{{ old('name') }}" type="text" class="form-control" placeholder="Nama Penilaian">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Nilai Minimum (KKM)<span class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                        <input name="minimum" value="{{ old('minimum') }}" type="number" class="form-control" placeholder="Penilaian Minimum" min="1" max="100">
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
