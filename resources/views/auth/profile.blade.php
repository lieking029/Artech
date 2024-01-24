@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mb-4 mt-3">
            <div class="card-header">
                {{ __('My profile') }}
            </div>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">{{ $message }}</div>
                    @endif

                    <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg></span>
                        <input class="form-control" type="text" name="name" placeholder="{{ __('Name') }}"
                            value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                            <label for="">Facebook</label>
                            <svg class="icon">
                            </svg></span>
                        <input class="form-control" type="text" name="facebook" placeholder="{{ __('Facebook') }}"
                            value="{{ old('facebook', auth()->user()->facebook) }}" required>
                        @error('facebook')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    <div class="input-group mb-3"><span class="input-group-text">
                            <label for="">Twitter</label>
                            <svg class="icon">
                            </svg></span>
                        <input class="form-control" type="text" name="twitter" placeholder="{{ __('Twitter') }}"
                            value="{{ old('twitter', auth()->user()->twitter) }}" required>
                        @error('twitter')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                            <label for="">Instagram</label>
                            <svg class="icon">
                            </svg></span>
                        <input class="form-control" type="text" name="instagram" placeholder="{{ __('Instagram') }}"
                            value="{{ old('instagram', auth()->user()->instagram) }}" required>
                        @error('instagram')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg></span>
                        <input class="form-control" type="file" name="profile" required>
                        @error('profile')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                            </svg></span>
                        <input class="form-control" type="text" name="email" placeholder="{{ __('Email') }}"
                            value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                            </svg></span>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                            placeholder="{{ __('New password') }}" required>
                        @error('password')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-4"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                            </svg></span>
                        <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                            name="password_confirmation" placeholder="{{ __('New password confirmation') }}" required>
                    </div>

                </div>

                <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="submit">{{ __('Submit') }}</button>
                </div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="text-danger">{{ $error }}</div>
                    @endforeach
                @endif
            </form>
        </div>
    </div>
@endsection
