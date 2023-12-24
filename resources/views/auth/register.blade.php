@extends('layouts.guest')

@section('content')
@if ($errors->any())
@foreach ($errors->all() as $error)
    <div class="text-danger">{{$error}}</div>
@endforeach
@endif
    <div class="col-md-6">
        <div class="card mb-4 mx-4 bg-transparent rounded-5 text-white" style="backdrop-filter: blur(30px); background-color: rgba(255, 255, 255, 0.1);">
            <div class="card-body border border-2 rounded-5  p-4">
                <h1>Register</h1>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="">Name</label>
                        <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg></span>
                            <input class="form-control" type="text" name="name" placeholder="{{ __('Name') }}" required
                                    autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                              <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                            </svg></span>
                                <input class="form-control" type="text" name="email" placeholder="{{ __('Email') }}" required
                                       autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="">Instagram</label>
                        <div class="input-group mb-3"><span class="input-group-text">
                            <i class="fab fa-instagram"></i>
                            </span>
                            <input class="form-control" type="text" name="instagram" placeholder="{{ __('Instagram') }}" required
                                   autocomplete="instagram">
                            @error('instagram')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Facebook</label>
                        <div class="input-group mb-3"><span class="input-group-text">
                            <i class="fab fa-facebook"></i>
                        </span>
                            <input class="form-control" type="text" name="facebook" placeholder="{{ __('Facebokk') }}" required
                                   autocomplete="facebook">
                            @error('facebook')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Twitter</label>
                        <div class="input-group mb-3"><span class="input-group-text">
                            <i class="fab fa-twitter"></i>
                            </span>
                                <input class="form-control" type="text" name="twitter" placeholder="{{ __('Twitter') }}" required
                                       autocomplete="twitter">
                                @error('twitter')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="">Profile Picture (Optional)</label>
                        <div class="input-group mb-3"><span class="input-group-text">
                            <i class="fas fa-file-pdf"></i>
                            </span>
                                <input class="form-control" type="file" name="profile" placeholder="{{ __('Twitter') }}">
                                @error('profile')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                              <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                            </svg></span>
                                <input class="form-control @error('password') is-invalid @enderror" type="password"
                                       name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <div class="input-group mb-4"><span class="input-group-text">
                            <svg class="icon">
                              <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                            </svg></span>
                                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                                       name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required
                                       autocomplete="new-password">
                            </div>
                    </div>

                    <button class="btn btn-block btn-dark text-white" type="submit">{{ __('Register') }}</button>

                </form>
            </div>
        </div>
    </div>

@endsection
