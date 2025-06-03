@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Siswa</div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            @if($student->photo)
                                <img src="{{ asset('storage/'.$student->photo) }}" class="img-thumbnail" style="max-width: 200px;">
                            @else
                                <img src="https://via.placeholder.com/200" class="img-thumbnail">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $student->first_name }} {{ $student->last_name }}</h3>
                            <p class="text-muted">NIS: {{ $student->student_id }}</p>
                            <hr>
                            <p><strong>No. HP:</strong> {{ $student->phone_number }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ $student->gender }}</p>
                            <p><strong>Alamat:</strong> {{ $student->address }}</p>
                        </div>
                    </div>

                    <div class="card-body border-top">
                    <h5>Ekstrakurikuler</h5>
                        @if($student->extracurriculars->isEmpty())
                            <p class="text-muted">Siswa belum mengikuti ekstrakurikuler</p>
                        @else
                            <ul class="list-group">
                                @foreach($student->extracurriculars as $ekskul)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $ekskul->name }}
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $ekskul->pivot->start_year }}
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                        <div>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">
                                Edit
                            </a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection