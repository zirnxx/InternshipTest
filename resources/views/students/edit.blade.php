@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Data Siswa</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.students.update', $student->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">Nama Depan</label>
                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $student->first_name }}" required autocomplete="first_name" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">Nama Belakang</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $student->last_name }}" required autocomplete="last_name">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="student_id" class="col-md-4 col-form-label text-md-end">Nomor Induk Siswa</label>
                            <div class="col-md-6">
                                <input id="student_id" type="text" class="form-control @error('student_id') is-invalid @enderror" name="student_id" value="{{ $student->student_id }}" required>
                                @error('student_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-end">Nomor HP</label>
                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $student->phone_number }}" required>
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">Jenis Kelamin</label>
                            <div class="col-md-6">
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                    <option value="Laki-laki" {{ $student->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $student->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Alamat</label>
                            <div class="col-md-6">
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" required>{{ $student->address }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="photo" class="col-md-4 col-form-label text-md-end">Foto</label>
                            <div class="col-md-6">
                                @if($student->photo)
                                    <img src="{{ asset('storage/'.$student->photo) }}" class="img-thumbnail mb-2" style="max-width: 150px; display: block;">
                                @endif
                                <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <label for="photo" class="col-md-4 col-form-label text-md-end">Foto</label>
    <div class="col-md-6">
        @if($student->photo)
            <img src="{{ asset('storage/'.$student->photo) }}" 
                 class="img-thumbnail mb-2" 
                 style="max-width: 150px; display: block;"
                 id="photo-preview">
            <button type="button" class="btn btn-sm btn-outline-danger mb-2" onclick="document.getElementById('photo-preview').style.display='none'; document.getElementById('remove-photo').value='1'">
                Hapus Foto
            </button>
            <input type="hidden" name="remove_photo" id="remove-photo" value="0">
        @endif
        <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" onchange="previewImage(this)">
        @error('photo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

@section('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('photo-preview');
        const file = input.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            if (!preview) {
                const img = document.createElement('img');
                img.id = 'photo-preview';
                img.className = 'img-thumbnail mb-2';
                img.style.maxWidth = '150px';
                img.style.display = 'block';
                img.src = e.target.result;
                input.parentNode.insertBefore(img, input);
            } else {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
        }
        
        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection