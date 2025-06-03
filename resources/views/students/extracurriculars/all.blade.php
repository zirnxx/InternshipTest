@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Siswa dan Ekstrakurikuler yang Diikuti</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Ekstrakurikuler</th>
            </tr>
        </thead>
        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
            Kembali ke Daftar Siswa
        </a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            Kembali ke Dashboard
        </a>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>
                        @if($student->extracurriculars->isEmpty())
                            <em>Tidak mengikuti ekstrakurikuler</em>
                        @else
                            <ul>
                                @foreach($student->extracurriculars as $extracurricular)
                                    <li>{{ $extracurricular->name }} (Mulai: {{ $extracurricular->pivot->start_year }})</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection