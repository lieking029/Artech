@extends('layouts.guest')

@section('content')
    <div class="col-lg-6 ">
        <div class="card-group d-block d-md-flex row">
            <div class="card col-md-7 p-4 mb-0 bg-transparent rounded-4 text-white" style="backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.1); border: 2px solid white">
                <div class="card-body">
                    <h1>{{ __('Login') }}</h1>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                                </svg>
                            </span>
                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email"
                                   placeholder="{{ __('Email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                                </svg>
                            </span>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                   name="password" placeholder="{{ __('Password') }}" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-dark px-4" type="submit">{{ __('Login') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
