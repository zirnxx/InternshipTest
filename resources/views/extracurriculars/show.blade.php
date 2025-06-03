@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Ekstrakurikuler</div>

                <div class="card-body">
                    <div class="mb-4">
                        <h3>{{ $extracurricular->name }}</h3>
                        <hr>
                        <p><strong>Penanggung Jawab:</strong> {{ $extracurricular->responsible_person }}</p>
                        <p>
                            <strong>Status:</strong> 
                            <span class="badge bg-{{ $extracurricular->status == 'Aktif' ? 'success' : 'danger' }}">
                                {{ $extracurricular->status }}
                            </span>
                        </p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('extracurriculars.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                        <div>
                            <a href="{{ route('extracurriculars.edit', $extracurricular->id) }}" class="btn btn-warning">
                                Edit
                            </a>
                            <form action="{{ route('extracurriculars.destroy', $extracurricular->id) }}" method="POST" class="d-inline">
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