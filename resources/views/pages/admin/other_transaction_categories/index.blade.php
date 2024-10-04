@extends('layouts.master')
@section('page_title', 'Kategori Transaksi Lainnya')
@section('content')

    <div class="card">
        @include('layouts.notification')
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Kategori Transaksi Lainnya</h6>
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
                @if(Auth::user() && Auth::user()->role->name == 'admin')
                    <li class="nav-item"><a href="#menabung" class="nav-link" data-toggle="tab"> Tambah Kategori</a></li>
                @endif
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-classes">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Status</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Diubah Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                        @if ($categories)
                            @foreach($categories as $c)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->status ? 'Aktif' : 'Tidak Aktif' }}</td>

                                    {{-- Menampilkan nama pembuat --}}
                                    <td>
                                        @foreach ($profiles as $profile)
                                            @if ($profile->id == $c->created_by)
                                                {{ $profile->profile->name ?? '-'}}
                                            @endif
                                        @endforeach
                                    </td>

                                    {{-- Menampilkan nama pembuat terakhir --}}
                                    <td>
                                        @foreach ($profiles as $profile)
                                            @if ($profile->id == $c->updated_by)
                                                {{ $profile->profile->name ?? '-' }}
                                            @endif
                                        @endforeach
                                    </td>

                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>
                                                @if(Auth::user() && Auth::user()->role->name == 'admin')
                                                    <div class="dropdown-menu dropdown-menu-left">


                                                        <a href="{{ route('other.cat.edit', $c->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>


                                                        {{-- <a id="{{ $c->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                        <form method="POST" id="item-delete-{{ $c->id }}" action="{{ route('other.cat.delete', $c->id) }}" class="hidden">@csrf @method('delete')</form> --}}

                                                    </div>
                                                @endif
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
                                <form method="POST" action="{{ route('other.cat.add') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">Nama Kategori <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
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
