<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('partials.inc_top')
    <link rel="stylesheet" href="{{ asset('assets/css/detail-student.css') }}">

    <title>{{ $student->name }}</title>
</head>
<body>
    <div class="container d-flex align-items-center">
        <img src="{{ asset('global_assets/images/vec-tutwuri.png') }}" alt="tut wurihandayani" width="90" class="text-left"><span class="title">HASIL BELAJAR SISWA SEKOLAH DASAR</span>
    </div>
    <div class="container text-center">
        <div class="row ">
            <div class="col">
                <span class="header-title">NAMA SISWA : {{ $student->student_profile->name ?? '..........................' }}</span>
            </div>
            <div class="col">
                <span class="header-title">NO.INDUK/NISN : {{ $student->student_profile->nisn ?? '..........................' }}</span>
            </div>
            <div class="col">
                <span class="header-title">KELAS : {{ $student->classroom->class_name ?? '..........................' }}</span>
            </div>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td colspan="2">TAHUN PELAJARAN</td>
                    <td colspan="3">{{ $student->classroom->period ?? '202..' }}</td>
                    <td colspan="3">{{ $student->classroom->period ?? '202..' }}</td>
                </tr>
                <tr>
                    <td rowspan="3">NO</td>
                    <td rowspan="3" style="width: 35vw">MATA PELAJARAN</td>
                    <td colspan="3">Semester I (Satu)</td>
                    <td colspan="3">Semester II (Dua)</td>
                </tr>
                <tr>
                    <td rowspan="2">KKM</td>
                    <td colspan="2">Nilai</td>
                    <td rowspan="2">KKM</td>
                    <td colspan="2">Nilai</td>
                </tr>
                <tr>
                    <td>Angka</td>
                    <td>Huruf</td>
                    <td>Angka</td>
                    <td>Huruf</td>
                </tr>
                @php
                    $lastIteration = 0;
                @endphp
                @foreach ($umum as $u)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left">{{ $u->name }}</td>
                        <td>{{ $u->minimum }}</td>
                        @php
                            $semester_1 = $assessments->where('assesment_id', $u->id)->where('semester', '1')->first();
                        @endphp
                        <td class="{{ optional($semester_1)->score_num < $u->minimum ? 'text-danger' : '' }}">{{ optional($semester_1)->score_num }}</td>
                        <td class="{{ optional($semester_1)->score_num < $u->minimum ? 'text-danger' : '' }}">{{ optional($semester_1)->score_let }}</td>
                        <td>{{ $u->minimum }}</td>
                        @php
                        $semester_2 = $assessments->where('assesment_id', $u->id)->where('semester', '2')->first();
                        @endphp
                        <td class="{{ optional($semester_2)->score_num < $u->minimum ? 'text-danger' : '' }}">{{ optional($semester_2)->score_num }}</td>
                        <td class="{{ optional($semester_2)->score_num < $u->minimum ? 'text-danger' : '' }}">{{ optional($semester_2)->score_let }}</td>
                    </tr>
                    @php
                        $lastIteration = $loop->iteration;
                    @endphp
                @endforeach

                <tr>
                    <td>{{ $lastIteration + 1 }}</td>
                    <td class="text-left">Muatan Lokal</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @if ($mulok)
                    @foreach ($mulok as $m )
                        <tr>
                            <td></td>
                            <td class="text-left">{{ $loop->iteration . '. ' . $m->name  }}</td>
                            <td>{{ $m->minimum }}</td>
                            <td></td>
                            <td></td>
                            <td>{{ $m->minimum }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td></td>
                        <td class="text-left">1.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-left">2.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-left">3.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
                <tr>
                    <td>No.</td>
                    <td class="text-left">Pengembangan Sikap Spiritual</td>
                    <td colspan="3">Predikat / Komentar</td>
                    <td colspan="3">Predikat / Komentar</td>
                </tr>
                @if ($spiritual)
                    @foreach ($spiritual as $sp )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left">{{ $sp->name }}</td>
                        <td colspan="3"></td>
                        <td colspan="3"></td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td>1.</td>
                        <td></td>
                        <td colspan="3"></td>
                        <td colspan="3"></td>
                    </tr>
                @endif
                <tr>
                    <td>No.</td>
                    <td class="text-left">Pengembangan Diri (Ekstra Kulikuler)</td>
                    <td colspan="3">Predikat / Komentar</td>
                    <td colspan="3">Predikat / Komentar</td>
                </tr>
                @if ($ekskul)
                    @foreach ($ekskul as $ek )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-left">{{ $ek->name }}</td>
                        <td colspan="3"></td>
                        <td colspan="3"></td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td>1.</td>
                        <td></td>
                        <td colspan="3"></td>
                        <td colspan="3"></td>
                    </tr>
                @endif
                    <tr>
                        <td></td>
                        <td  class="text-left">
                            <span class="sp-2">Ketidak Hadiran</span><br>
                            <span class="sp-2">Sakit</span><br>
                            <span class="sp-2">Izin</span><br>
                            <span class="sp-2">Tanpa Keterangan</span><br>
                            <span class="sp-2">Jml. Ketidak Hadiran</span>
                        </td>
                        <td colspan="3">
                            <span class="sp-2">.....................Hari</span><br>
                            <span class="sp-2">.....................Hari</span><br>
                            <span class="sp-2">.....................Hari</span><br>
                            <span class="sp-2">.....................Hari</span><br>
                            <span class="sp-2">.....................Hari</span><br>
                        </td>
                        <td colspan="3">
                            <span class="sp-2">.....................Hari</span><br>
                            <span class="sp-2">.....................Hari</span><br>
                            <span class="sp-2">.....................Hari</span><br>
                            <span class="sp-2">.....................Hari</span><br>
                            <span class="sp-2">.....................Hari</span><br>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-left">Keputusan Akhir Tahun Pelajaran</td>
                        <td colspan="6" class="text-left">
                            Naik Kelas <br>
                            Tidak Naik*) ke Kelas : .................(.................) <br>
                            Lulus / Tidak Lulus *)
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-left">Peringkat Ke</td>
                        <td colspan="3">:..............Dari Siswa :..............</td>
                        <td colspan="3">:..............Dari Siswa :..............</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-left">
                            Buku Induk ini di Setujui Oleh : <br>
                            Guru / Wali Kelas dan <br>
                            Kepala Sekolah
                        </td>
                        <td colspan="3" class="text-left">
                            Guru / Wali Kelas
                            <span class="sp-3">{{ $student->classroom->teacher->user->profile->name ?? '..........................' }}</span>
                            <p class="sp-3">NIP : {{ $student->classroom->teacher->nip }}</p>
                            Kepala Sekolah
                            <span class="sp-3">{{ $ks->profile->name ??  '..........................' }}</span>
                            <p class="sp-3">NIP : {{ $ks->teacher->nip ?? '' }}</p>
                        </td>
                        <td colspan="3" class="text-left">
                            Guru / Wali Kelas
                            <span class="sp-3">{{ $student->classroom->teacher->user->profile->name ?? '..........................' }}</span>
                            <p class="sp-3">NIP : {{ $student->classroom->teacher->nip }}</p>
                            Kepala Sekolah
                            <span class="sp-3">{{ $ks->profile->name ??  '..........................' }}</span>
                            <p class="sp-3">NIP : {{ $ks->teacher->nip ?? '' }}</p>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
