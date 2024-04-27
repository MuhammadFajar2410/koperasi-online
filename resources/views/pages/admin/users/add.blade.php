@extends('layouts.master')
@section('page_title', 'Anggota Baru')
@section('content')

    <div class="card">
        @include('layouts.notification')
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Anggota Baru</h6>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <form method="POST"  class="wizard-form steps-validation" action="{{ route('add.user') }}" data-fouc>
            @csrf
             <h6>Data diri</h6>
             <fieldset>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Nama Lengkap: <span class="text-danger">*</span></label>
                            <input type="text" id="name" value="{{ old('name') }}" name="name" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="address">Alamat Lengkap: <span class="text-danger">*</span></label>
                            <input type="text" id="address" value="{{ old('adddress') }}" name="address" class="form-control" placeholder="Alamat Lengkap" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>No. Anggota</label>
                            <input type="text" value="{{ old('member_id') }}" name="member_id" class="form-control" placeholder="Nomor Anggota">
                        </div>
                    </div>

                    <div class="col-md-3">
                       <div class="form-group">
                        <label for="gender">Jenis Kelamin: <span class="text-danger">*</span></label>
                        <select class="select form-control" id="gender" name="gender" data-fouc data-placeholder="Choose.." required>
                            <option value=""></option>
                            @foreach ($genders as $value=>$label )
                                <option {{ old('gender') == $value ? 'selected' : '' }} value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                       </div>
                   </div>

                   <div class="col-md-3">
                        <div class="form-group">
                            <label>Pekerjaan <span class="text-danger">*</span></label>
                            <input value="{{ old('job') }}" type="text" name="job" placeholder="Pekerjaan" class="form-control" required>
                        </div>
                    </div>

                   <div class="col-md-3">
                        <div class="form-group">
                            <label>Tanggal Bergabung <span class="text-danger">*</span></label>
                            <input value="{{ old('joinOn') }}" type="date" name="joinOn" placeholder="Tanggal Bergabung" class="form-control" required>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Simpanan Pokok</label>
                            <input type="text" value="{{ old('amount') }}" name="amount" placeholder="Simpanan Pokok" class="form-control">
                        </div>
                    </div>


                </div>

             </fieldset>
             <h6>Akun login</h6>
             <fieldset>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Username</label>
                            <input name="username" value="{{ old('username') }}" type="text" class="form-control" placeholder="Username Login">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" value="{{ old('password') }}" type="password" class="form-control" placeholder="Password">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password_confirmation" value="{{ old('password_confirmation') }}" type="password" class="form-control" placeholder="Konfirmasi Password">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="role_id">Jabatan: <span class="text-danger">*</span></label>
                            <select name="role_id" class="select-search form-control" id="role_id" data-fouc data-placeholder="Choose.." required >
                                <option value=""></option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                 </div>
             </fieldset>

         </form>
    </div>

    {{--TimeTable Ends--}}

@endsection
