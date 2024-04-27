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

        <form method="POST" enctype="multipart/form-data" class="wizard-form steps-validation" action="{{ url('students.add') }}" data-fouc>
            @csrf
             <h6>Data diri</h6>
             <fieldset>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Nama Lengkap :</label>
                            <input type="text" id="name" value="{{ old('name') }}" name="name" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="address">Alamat Lengkap</label>
                            <input type="text" id="address" value="{{ old('adddress') }}" name="address" class="form-control" placeholder="Alamat Lengkap" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>NIS:</label>
                            <input type="text" value="{{ old('nis') }}" name="nis" class="form-control" placeholder="Nomor Induk Siswa">
                        </div>
                    </div>

                    <div class="col-md-3">
                       <div class="form-group">
                           <label>NISN:</label>
                           <input type="text" value="{{ old('nisn') }}" name="nisn" class="form-control" placeholder="Nomor Induk Siswa Nasional">
                       </div>
                   </div>

                   <div class="col-md-3">
                        <div class="form-group">
                            <label>Nama Lengkap: <span class="text-danger">*</span></label>
                            <input value="{{ old('name') }}" type="text" name="name" placeholder="Nama Lengkap" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nama Panggilan: </label>
                            <input value="{{ old('nickname') }}" type="text" name="nickname" placeholder="Nama Panggilan" class="form-control">
                        </div>
                    </div>
                </div>

                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Alamat: <span class="text-danger">*</span></label>
                            <input value="{{ old('address') }}" class="form-control" placeholder="Alamat Lengkap" name="address" type="text" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date of Birth:</label>
                            <input name="dob" value="{{ old('dob') }}" type="text" class="form-control date-pick" placeholder="Select Date...">

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tempat Lahir:</label>
                            <input name="pob" value="{{ old('pob') }}" type="text" class="form-control" placeholder="Tempat Lahir">

                        </div>
                    </div>

                 </div>

                 <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gender">Gender: <span class="text-danger">*</span></label>
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
                             <label>Agama:</label>
                             <input name="religion" value="{{ old('religion') }}" type="text" class="form-control" placeholder="Agama">

                         </div>
                     </div>


                     {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label for="nationality">Kewarganegaraan: <span class="text-danger">*</span></label>
                        <select class="select form-control" id="nationality" name="nationality" data-fouc data-placeholder="Choose.." required>
                                <option value=""></option>
                                @foreach ($nationalities as $value=>$label )
                                    <option {{ old('nationality') == $value ? 'selected' : '' }} value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jumlah Saudara:</label>
                            <input name="siblings_count" value="{{ old('siblings_count') }}" type="text" class="form-control" placeholder="Jumlah Saudara">

                        </div>
                    </div>
                 </div>
                 <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Bahasa Sehari-hari</label>
                            <input name="daily_language" value="{{ old('daily_language') }}" type="text" class="form-control" placeholder="Bahasa Sehari-hari">

                        </div>
                    </div>

                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label for="blood_type">Golongan Darah:</label>
                            <select class="select-search form-control" id="blood_type" name="blood_type" data-fouc data-placeholder="Choose..">
                                <option value=""></option>
                                @foreach ($blood_type as $value=>$label )
                                    <option {{ old('blood_type') == $value ? 'selected' : '' }} value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nomor Telepon :</label>
                            <input name="phone" value="{{ old('phone') }}" type="text" class="form-control" placeholder="Nomor Telepon">

                        </div>
                    </div>
                 </div>

             </fieldset>

             <h6>Data Tambahan</h6>
             <fieldset>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nama Ayah:</label>
                            <input name="father_name" value="{{ old('father_name') }}" type="text" class="form-control" placeholder="Nama Lengkap Ayah">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nama Ibu:</label>
                            <input name="mother_name" value="{{ old('mother_name') }}" type="text" class="form-control" placeholder="Nama Lengkap Ibu">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Pendidikan Tertinggi Ayah:</label>
                            <input name="father_highest_education" value="{{ old('father_highest_education') }}" type="text" class="form-control" placeholder="Pendidikan Tertinggi Ayah">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Pendidikan Tertinggi Ibu:</label>
                            <input name="mother_highest_education" value="{{ old('mother_highest_education') }}" type="text" class="form-control" placeholder="Pendidikan Tertinggi Ibu">
                        </div>
                    </div>
                 </div>

                 <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Pekerjaan Ayah:</label>
                            <input name="father_occupation" value="{{ old('father_occupation') }}" type="text" class="form-control" placeholder="Pekerjaan Ayah">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Pekerjaan Ibu:</label>
                            <input name="mother_occupation" value="{{ old('mother_occupation') }}" type="text" class="form-control" placeholder="Pekerjaan Ibu">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Wali Murid:</label>
                            <input name="student_guardian" value="{{ old('student_guardian') }}" type="text" class="form-control" placeholder="Penanggung Jawab Siswa">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Hubungan Keluarga:</label>
                            <input name="relationship" value="{{ old('relationship') }}" type="text" class="form-control" placeholder="Hubungan Keluarga dengan Siswa">
                        </div>
                    </div>
                 </div>

                 <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Pendidikan Tertinggi Wali Murid</label>
                            <input name="guardian_highest_education" value="{{ old('guardian_highest_education') }}" type="text" class="form-control" placeholder="Pendidikan Tertinggi Wali Murid">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Pekerjaan Wali Murid</label>
                            <input name="guardian_occupation" value="{{ old('guardian_occupation') }}" type="text" class="form-control" placeholder="Pekerjaan Wali Murid">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Bertempat tinggal pada:</label>
                            <input name="residence_type" value="{{ old('residence_type') }}" type="text" class="form-control" placeholder="Rumah Pribadi/Mengontrak/Apartement/dsb.">

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jarak Ke Sekolah</label>
                            <input name="school_distance" value="{{ old('school_distance') }}" type="text" class="form-control" placeholder="Jarak Ke Sekolah">

                        </div>
                    </div>
                 </div>

                 <div class="row">

                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label for="class_id">Kelas:</label>
                            <select class="select-search form-control" id="class_id" name="class_id" data-fouc data-placeholder="Choose.." required>
                                <option value=""></option>
                                @foreach ($classroom as $c )
                                    <option {{ old('classroom') == $c->id ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->class_name . ' - ' . $c->period }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="d-block">Upload Foto:</label>
                            <input value="{{ old('img') }}" accept="image/*" type="file" name="img" class="form-input-styled" data-fouc>
                            <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                        </div>
                    </div>
                 </div>
             </fieldset>

         </form>
    </div>

    {{--TimeTable Ends--}}

@endsection
