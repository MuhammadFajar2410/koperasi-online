@extends('layouts.master')
@section('page_title', 'Edit User')
@section('content')

    <div class="card">
        @include('layouts.notification')
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Edit User</h6>

        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#change-pass" class="nav-link active" data-toggle="tab">Change Password</a></li>
                <li class="nav-item"><a href="#edit-profile" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Manage Profile</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="change-pass">
                    <div class="row">
                        <div class="col-md-8">
                                <form method="POST" action="{{ route('user.update', $user->id) }}">
                                    @csrf @method('PATCH')

                                    <div class="form-group row">
                                        <label for="username" class="col-lg-3 col-form-label font-weight-semibold">Username <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="username" name="username" value="{{ $user->username }}" type="text" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-lg-3 col-form-label font-weight-semibold">Password Baru <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="password" name="password"  type="password" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password_confirmation" class="col-lg-3 col-form-label font-weight-semibold">Konfirmasi Password <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="password_confirmation" name="password_confirmation"  type="password" class="form-control">
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-danger">Submit form <i class="icon-paperplane ml-2"></i></button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
                    <div class="tab-pane fade" id="edit-profile">
                        <div class="row">
                            <div class="col-md-6">
                                <form enctype="multipart/form-data" method="post" action="{{ route('profile.update', $user->id) }}">
                                    @csrf @method('PATCH')

                                    <div class="form-group row">
                                        <label for="member_id" class="col-lg-3 col-form-label font-weight-semibold">Nomor Anggota <span class="text-danger"></span></label>
                                        <div class="col-lg-9">
                                            <input id="member_id" name="member_id" class="form-control" type="text" value="{{ $user->profile->member_id }}" placeholder="Nomor Anggota boleh dikosongkan jika belum ada" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-lg-3 col-form-label font-weight-semibold">Nama <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input id="name" name="name" class="form-control" type="text" value="{{ $user->profile->name }}" placeholder="Nama Lengkap" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="address" class="col-lg-3 col-form-label font-weight-semibold">Alamat <span class="text-danger"></span></label>
                                        <div class="col-lg-9">
                                            <input id="address" name="address" class="form-control" type="text" value="{{ $user->profile->address }}" placeholder="Alamat Lengkap">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="gender" class="col-lg-3 col-form-label font-weight-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select class="select-search form-control" id="gender" name="gender" data-fouc data-placeholder="Choose.." required>
                                                <option value=""></option>
                                                <option value="l" {{ $user->profile->gender == 'l' ? 'selected' : '' }}>Laki-Laki</option>
                                                <option value="p" {{ !$user->profile->gender == 'l' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="job" class="col-lg-3 col-form-label font-weight-semibold">Pekerjaan <span class="text-danger"></span></label>
                                        <div class="col-lg-9">
                                            <input id="job" name="job" class="form-control" type="text" value="{{ $user->profile->job }}" placeholder="Pekerjaan">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="role_id" class="col-lg-3 col-form-label font-weight-semibold">Role <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select class="select-search form-control" id="role_id" name="role_id" data-fouc data-placeholder="Choose.." required>
                                                <option value=""></option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>
                                                        {{ ucwords($role->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="status" class="col-lg-3 col-form-label font-weight-semibold">Role <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select class="select-search form-control" id="status" name="status" data-fouc data-placeholder="Choose.." required>
                                                <option value=""></option>
                                                <option value="1" {{ $user->status ? 'selected' : '' }}>Aktif</option>
                                                <option value="0" {{ !$user->status ? 'selected' : '' }}>Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="exitOn" class="col-lg-3 col-form-label font-weight-semibold">Keluar Tanggal <span class="text-danger"></span></label>
                                        <div class="col-lg-9">
                                            <input id="exitOn" name="exitOn" class="form-control" type="date">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="reason" class="col-lg-3 col-form-label font-weight-semibold">Alasan Keluar<span class="text-danger"></span></label>
                                        <div class="col-lg-9">
                                            <input id="reason" name="reason" class="form-control" type="text" placeholder="Wajib diisi jika anggota keluar">
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row">
                                        <label for="phone" class="col-lg-3 col-form-label font-weight-semibold">Phone </label>
                                        <div class="col-lg-9">
                                            <input id="phone" value="{{ $my->phone }}" name="phone"  type="text" class="form-control" >
                                        </div>
                                    </div> --}}

                                    {{-- <div class="form-group row">
                                        <label for="phone2" class="col-lg-3 col-form-label font-weight-semibold">Telephone </label>
                                        <div class="col-lg-9">
                                            <input id="phone2" value="{{ $my->phone2 }}" name="phone2"  type="text" class="form-control" >
                                        </div>
                                    </div> --}}

                                    {{-- <div class="form-group row">
                                        <label for="address" class="col-lg-3 col-form-label font-weight-semibold">Address </label>
                                        <div class="col-lg-9">
                                            <input id="address" value="{{ $my->address }}" name="address"  type="text"  class="form-control" >
                                        </div>
                                    </div> --}}

                                    {{-- <div class="form-group row">
                                        <label for="address" class="col-lg-3 col-form-label font-weight-semibold">Change Photo </label>
                                        <div class="col-lg-9">
                                            <input  accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="form-group row">
                                        <label for="role_id" class="col-lg-3 col-form-label font-weight-semibold">Role <span class="text-danger">*</span></label>
                                        <select class="select-search form-control" id="role_id" name="role_id" data-fouc data-placeholder="Choose.." required>
                                            <option value=""></option>
                                            @foreach ($roles as $role )
                                                <option value="{{ $role->id }} {{ $role->id == $user->role_id ? 'selected' : '' }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-danger">Submit form <i class="icon-paperplane ml-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    {{--My Profile Ends--}}

@endsection
