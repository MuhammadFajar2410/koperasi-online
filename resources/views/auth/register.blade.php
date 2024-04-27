@extends('layouts.login_master')

@section('content')
    <div class="page-content login-cover">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center">

                <!-- Login card -->
                <form class="login-form " method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="icon-people icon-2x text-warning-400 border-warning-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">Register</h5>
                                <span class="d-block text-muted">T</span>
                            </div>
                            @include('layouts.notification')

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-styled-left alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                        <span class="font-weight-semibold">Oops!</span> {!! implode('<br>', $errors->all()) !!}
                                    </div>
                                @elseif(session('success'))
                                    <div class="alert alert-success alert-dismissable fade show text-center">
                                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                        {{session('success')}}
                                    </div>
                                @endif


                            <div class="form-group ">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nama Siswa">
                            </div>

                            <div class="form-group ">
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Login ID atau Email">
                            </div>

                            <div class="form-group ">
                                <input required name="password" type="password" class="form-control" placeholder="{{ __('Password') }}">

                            </div>

                            <div class="form-group ">
                                <input required name="password_confirmation" type="password" class="form-control" placeholder="{{ __('Confirm Password') }}">

                            </div>

                            <div class="form-group d-flex align-items-center">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
                                <a href="{{ route('login-page') }}" class="btn btn-primary btn-block">Login <i class="icon-circle-right2 ml-2"></i></a>
                            </div>


                        </div>
                    </div>
                </form>

            </div>


        </div>

    </div>
    @endsection
