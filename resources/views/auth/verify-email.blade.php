@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow rounded-3">
                <div class="card-header bg-warning text-dark">
                    {{ __('Verify Your Email Address') }}
                </div>

                <div class="card-body">

                    {{-- Flash Message --}}
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <p>
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email, you can request another below.') }}
                    </p>

                    {{-- Resend Verification Form --}}
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            {{ __('Resend Verification Email') }}
                        </button>
                    </form>

                    {{-- Optional: Logout --}}
                    <hr>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link text-danger p-0">
                            {{ __('Logout') }}
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
