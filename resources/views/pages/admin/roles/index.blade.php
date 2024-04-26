@extends('layouts.master')
@section('page_title', 'Manajemen Jabatan')
@section('content')

    <div class="card">
        @include('layouts.notification')
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Manajemen Jabatan</h6>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Jabatan</a></li>
                <li class="nav-item"><a href="#new-class" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i>Tambah Jabatan Baru</a></li>
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-classes">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jabatan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                {{-- <th>Status</th> --}}
                            </tr>
                            </thead>
                            <tbody>
                        @if ($roles)
                            @foreach($roles as $r)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $r->name }}</td>
                                    <td>{{ $r->status ? 'Aktif' : 'Non Aktif' }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">


                                                    <a href="{{ route('role.edit', $r->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>


                                                    <a id="{{ $r->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                    <form method="POST" id="item-delete-{{ $r->id }}" action="{{ route('role.destroy', $r->id) }}" class="hidden">@csrf @method('delete')</form>

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
                            <form method="POST" action="{{ route('role.add') }}">
                                @csrf
                                <div class="form-group row">
                                    <span class="text-danger"></span>
                                    <label class="col-lg-12 col-form-label font-weight-semibold">Nama Jabatan <span class="text-danger">*(Harap gunakan huruf kecil semua)</span></label>
                                    <div class="col-lg-12">
                                        <input name="name" value="{{ old('name') }}" required type="text" class="form-control" placeholder="Nama Jabatan" required>
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
