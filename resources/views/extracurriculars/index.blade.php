@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Daftar Ekstrakurikuler</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('extracurriculars.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Ekstrakurikuler
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Ekstrakurikuler</th>
                    <th>Penanggung Jawab</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($extracurriculars as $extracurricular)
                <tr>
                    <td>{{ $loop->iteration + ($extracurriculars->currentPage() - 1) * $extracurriculars->perPage() }}</td>
                    <td>{{ $extracurricular->name }}</td>
                    <td>{{ $extracurricular->responsible_person }}</td>
                    <td>
                        <span class="badge bg-{{ $extracurricular->status == 'Aktif' ? 'success' : 'danger' }}">
                            {{ $extracurricular->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.extracurriculars.show', $extracurricular->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.extracurriculars.edit', $extracurricular->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.extracurriculars.destroy', $extracurricular->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $extracurriculars->links() }}
    </div>
</div>
@endsection