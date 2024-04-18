@extends('layouts.master')
@section('page_title', 'Manajemen Kelas')
@section('content')

    <div class="card">
        @include('layouts.notification')
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Manajemen Kelas </h6>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Kelas</a></li>
                <li class="nav-item"><a href="#new-class" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Tambah Kelas Baru</a></li>
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-classes">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kelas</th>
                                <th>Tingkatan Kelas</th>
                                <th>Wali Kelas</th>
                                <th>Tahun Ajaran</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                        @if ($classlist)
                            @foreach($classlist as $c)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $c->class_name }}</td>
                                    <td>{{ $c->grade }}</td>
                                    <td>{{ optional(optional(optional($c->teacher)->user)->profile)->name ?: 'Belum Ada' }}</td>
                                    <td>{{ $c->period }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">

                                                    {{-- view --}}
                                                    <a href="{{ route('classroom.view', $c->id) }}" class="dropdown-item"><i class="icon-eye"></i> View</a>

                                                    {{--Edit--}}
                                                    {{-- <a href="{{ route('classroom.edit', $c->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a> --}}


                                                    {{--Delete--}}
                                                    <a id="{{ $c->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                    <form method="POST" id="item-delete-{{ $c->id }}" action="{{ route('classroom.destroy', $c->id) }}" class="hidden">@csrf @method('delete')</form>

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
                            <form method="POST" action="{{ route('classroom.add') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Nama Kelas <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="class_name" value="{{ old('class_name') }}" type="text" class="form-control" placeholder="Nama Kelas" required >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Wali Kelas <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select name="teacher_id" id="teacher_id" class="form-control select">
                                            <option value="null">Belum ada</option>
                                                @foreach ($homeroom as $teacher )
                                                    <option value="{{ $teacher->id }}">{{ $teacher->user->profile->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Tingkatan <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select name="grade" id="grade" class="form-control select">
                                            @foreach ($grades as $grade )
                                                <option value="{{ $grade }}">{{ $grade }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Tahun Ajaran <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="period" value="{{ old('period') }}" type="text" class="form-control" placeholder="Tahun Ajaran" required >
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button id="ajax-btn" type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
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
