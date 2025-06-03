@extends('layouts.app')

@section('content')
<h3>Tambah Ekstrakurikuler untuk Siswa: {{ $student->name }}</h3>

<form action="{{ route('admin.students.extracurriculars.store', $student->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="extracurricular_id" class="form-label">Pilih Ekstrakurikuler</label>
        <select name="extracurricular_id" id="extracurricular_id" class="form-select" required>
            <option value="">-- Pilih Ekstrakurikuler --</option>
            @foreach($extracurriculars as $extra)
                <option value="{{ $extra->id }}">{{ $extra->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="start_year" class="form-label">Tahun Mulai Mengikuti</label>
        <input type="number" name="start_year" class="form-control" required>
        <small class="text-muted">Format tahun: 4 digit, contoh: 2024</small>
    </div>

    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
    <a href="{{ route('admin.students.extracurriculars.page') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection