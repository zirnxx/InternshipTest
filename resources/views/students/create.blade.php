@extends('layouts.app')

@section('title', 'Tambah Siswa Baru')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Tambah Siswa Baru</span>
                    <a href="{{ route('students.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.students.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">
                                Nama Depan <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input id="first_name" type="text" 
                                       class="form-control @error('first_name') is-invalid @enderror" 
                                       name="first_name" 
                                       value="{{ old('first_name') }}" 
                                       required autocomplete="first_name" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">
                                Nama Belakang <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" 
                                       class="form-control @error('last_name') is-invalid @enderror" 
                                       name="last_name" 
                                       value="{{ old('last_name') }}" 
                                       required autocomplete="last_name">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="student_id" class="col-md-4 col-form-label text-md-end">
                                NIS <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input id="student_id" type="text" 
                                       class="form-control @error('student_id') is-invalid @enderror" 
                                       name="student_id" 
                                       value="{{ old('student_id') }}" 
                                       required>
                                @error('student_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-end">
                                No. HP <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input id="phone_number" type="text" 
                                       class="form-control @error('phone_number') is-invalid @enderror" 
                                       name="phone_number" 
                                       value="{{ old('phone_number') }}" 
                                       required>
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <select id="gender" 
                                        class="form-control @error('gender') is-invalid @enderror" 
                                        name="gender" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>
                                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">
                                Alamat <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <textarea id="address" 
                                          class="form-control @error('address') is-invalid @enderror" 
                                          name="address" 
                                          required>{{ old('address') }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="photo" class="col-md-4 col-form-label text-md-end">
                                Foto Profil
                            </label>
                            <div class="col-md-6">
                                <input id="photo" type="file" 
                                       class="form-control @error('photo') is-invalid @enderror" 
                                       name="photo"
                                       accept="image/jpeg,image/png">
                                <small class="text-muted">Format: JPEG/PNG (Maks. 2MB)</small>
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection