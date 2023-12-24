<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://kit.fontawesome.com/5e81b262d9.js" crossorigin="anonymous"></script>
    <meta name="theme-color" content="#ffffff">
    @vite('resources/sass/app.scss')
</head>
<body>

<style>
    .bg-pic {
        background-image: url('{{ asset('auth-bg.png') }}');
        /* backdrop-filter: blur(10px); */
    }
</style>

<div class="bg-pic min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
</body>
</html>
