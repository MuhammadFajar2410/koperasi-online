@extends('layouts.master')
@section('page_title', 'My Profile')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">My Profile</h6>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#change-pass" class="nav-link active" data-toggle="tab">Change Password</a></li>
                <li class="nav-item"><a href="#edit-profile" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> My Profile</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="change-pass">
                    <div class="row">
                        <div class="col-md-8">
                            <form method="POST" action="{{ route('change.password', Auth::id()) }}">
                                @csrf @method('PATCH')

                                <div class="form-group row">
                                    <label for="current_password" class="col-lg-3 col-form-label font-weight-semibold">Current Password <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="current_password" name="current_password"  required type="password" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-lg-3 col-form-label font-weight-semibold">New Password <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="password" name="password"  required type="password" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-lg-3 col-form-label font-weight-semibold">Confirm Password <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="password_confirmation" name="password_confirmation"  required type="password" class="form-control" >
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
                        <div class="form-group col-4 offset-1">
                            <label for="name">Nama :</label>
                            <input type="text" value="{{ $user->profile->name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="name">Alamat :</label>
                            <input type="text" value="{{ $user->profile->address }}" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-4 offset-1">
                            <label for="name">Pekerjaan :</label>
                            <input type="text" value="{{ ucwords($user->profile->job) }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="name">Jenis Kelamin :</label>
                            <input type="text" value="{{ $user->profile->gender == 'l' ? 'Laki-Laki' : 'Perempuan' }}" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-4 offset-1">
                            <label for="name">Pekerjaan :</label>
                            <input type="text" value="{{ ucwords($user->profile->job) }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="name">Jenis Kelamin :</label>
                            <input type="text" value="{{ $user->profile->gender == 'l' ? 'Laki-Laki' : 'Perempuan' }}" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-4 offset-1">
                            <label for="name">Role :</label>
                            <input type="text" value="{{ ucwords($user->role->name) }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-4">
                            <br>
                            <span class="text-danger">* Jika ada ketidak sesuaian data silahkan hubungi ketua atau admin</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--My Profile Ends--}}

@endsection
