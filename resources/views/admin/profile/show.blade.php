@extends('layouts.app')

@section('title', 'Admin Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Profile') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">{{ __('First Name') }}</label>
                        <p class="form-control-plaintext">{{ $admin->first_name }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Last Name') }}</label>
                        <p class="form-control-plaintext">{{ $admin->last_name }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Email') }}</label>
                        <p class="form-control-plaintext">{{ $admin->email }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Birth Date') }}</label>
                        <p class="form-control-plaintext">{{ $admin->birth_date->format('d/m/Y') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Gender') }}</label>
                        <p class="form-control-plaintext">{{ ucfirst($admin->gender) }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">
                            {{ __('Edit Profile') }}
                        </a>
                        <a href="{{ route('admin.profile.edit.password') }}" class="btn btn-secondary">
                            {{ __('Change Password') }}
                        </a>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection