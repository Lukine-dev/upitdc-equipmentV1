@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow rounded-3">
                <div class="card-header bg-primary text-white">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Full Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- CU / Campus --}}
                        <div class="mb-3">
                            <label for="cu" class="form-label">{{ __('CU / Campus') }}</label>
                            <input id="cu" type="text" class="form-control @error('cu') is-invalid @enderror"
                                   name="cu" value="{{ old('cu') }}" required>
                            @error('cu')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Designation --}}
                        <div class="mb-3">
                            <label for="designation" class="form-label">{{ __('Designation') }}</label>
                            <input id="designation" type="text" class="form-control @error('designation') is-invalid @enderror"
                                   name="designation" value="{{ old('designation') }}" required>
                            @error('designation')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Department / Office Unit --}}
                        <div class="mb-3">
                            <label for="department" class="form-label">{{ __('Department / Office Unit') }}</label>
                            <input id="department" type="text" class="form-control @error('department') is-invalid @enderror"
                                   name="department" value="{{ old('department') }}" required>
                            @error('department')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" required>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>
                        </div>

                        {{-- Submit --}}
                        <div class="mb-0">
                            <button type="submit" class="btn btn-success w-100">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
