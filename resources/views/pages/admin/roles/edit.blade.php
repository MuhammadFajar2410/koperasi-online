@extends('layouts.master')
@section('page_title', 'Edit Jabatan')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Edit Jabatan</h6>
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
                    <form method="POST" action="{{ route('role.update', $role->id) }}">
                        @csrf @method('PATCH')
                        <div class="form-group row">
                            <label class="col-lg-12 col-form-label font-weight-semibold">Nama Jabatan <span class="text-danger">*(Harap gunakan huruf kecil semua)</span></label>
                            <div class="col-lg-12">
                                <input name="name" value="{{ $role->name }}" required type="text" class="form-control" placeholder="Nama Jabatan" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-12 col-form-label font-weight-semibold">Status <span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                                <select name="status" id="status" class="form-control select" required>
                                    <option value="0" {{ !$role->status ? 'selected' : ''  }}>Non Aktif</option>
                                    <option value="1" {{ $role->status ? 'selected' : ''  }}>Aktif</option>
                                </select>
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
