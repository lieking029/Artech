<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/5e81b262d9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.0.0-rc.1/dist/css/coreui.min.css" rel="stylesheet"
        integrity="sha384-6YUohc5ifdoNCo0LbNiTPUr/PgSpk8g4xTkq3gTstOpNuzSI4CPX8jNul1r9kpFV" crossorigin="anonymous">


    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <meta name="theme-color" content="#ffffff">
    @vite('resources/sass/app.scss')
</head>

<body data-coreui-theme="dark">
    <style>
        .upload-box {
            border: 2px dashed #4C5370;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            background-color: #f8f9fa;
        }

        .upload-box:hover {
            background-color: #e2e6ea;
        }

        .upload-box p {
            margin: 0;
            font-size: 16px;
            color: #4C5370;
        }
    </style>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar" style="background: black">
        <div class="sidebar-brand d-none d-md-flex">
            <img src="{{ asset('icons/422586308_931194221947249_7808288288687460354_n.png') }}" alt=""
                srcset="" style="width: 130px; height:100px;">
            <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="{{ asset('icons/brand.svg#signet') }}"></use>
            </svg>
        </div>
        @include('layouts.navigation')
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100" style="">
        <header class="header header-sticky" style="background: #18191A">
            <div class="container-fluid">
                <ul class="header-nav ms-auto">

                </ul>
                <div class="form-check form-switch mx-4">
                    <input class="form-check-input p-2" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                        checked onclick="myFunction()" />
                </div>
                <h5 class="text-white mx-4 mt-2">Wallet: ₱{{ number_format(auth()->user()->wallet, 2) }}</h5>
                <a href="{{ route('topUp.index') }}" class="btn btn-primary">Top Up</a>
                <a href="{{ route('cashout.index') }}" class="btn btn-success mx-4">Cash Out</a>
                <a href="{{ route('cart.index') }}">
                    <i class="fas fa-shopping-bag text-white fa-2x"></i>
                </a>
                <ul class="header-nav ms-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link py-0 text-white dropdown-toggle" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end pt-0" style="background: rgb(47, 46, 49)"
                            aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-white" href="{{ route('profile.show') }}">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                                    </svg>
                                    {{ __('My profile') }}
                                </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" style="display: none;"
                                    id="logout-form">
                                    @csrf
                                </form>
                                <a class="dropdown-item text-white" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
                                    </svg>
                                    {{ __('Logout') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>
        <div class="body d-flex flex-grow-1 px-0 w-100">
            <div class="container-fluid p-0 w-100">
                @yield('content')
            </div>
        </div>
        {{-- <footer class="footer">
        <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> &copy; 2021
            creativeLabs.
        </div>
        <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/bootstrap/ui-components/">CoreUI UI
                Components</a></div>
    </footer> --}}
        {{-- MODAL --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-white" style="background: #242526">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create</h5>
                        <button type="button" class="btn-close btn-close-white" data-coreui-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form
                        action="@admin
{{ route('art.admin') }}
@endadmin @client
{{ route('art.store') }}
@endclient"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="" class="mb-2">Art Category</label>
                                <select name="category_id" id="" class="form-select">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group mt-3">
                                <label for="" class="mb-2">Art Title</label>
                                <input type="text" placeholder="Title" name="title" class="form-control">
                            </div>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group mt-3">
                                <label for="image" class="mb-2">Your ART</label>
                                <div class="upload-box"
                                    onclick="document.getElementById('formFileMultiple').click();">
                                    <p>Click to upload files</p>
                                </div>
                                <input class="form-control d-none" name="image[]" type="file"
                                    id="formFileMultiple" multiple required>
                            </div>
                            @error('image.*')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group mt-3">
                                <label for="sale" class="mb-2">Sale</label>
                                <select name="sale" id="sale" class="form-select">
                                    <option id="not-for-sale" value="0" selected>Not For Sale</option>
                                    <option id="for-sale" value="1">For Sale</option>
                                </select>
                            </div>
                            @error('sale')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group mt-3">
                                <label for="sale" class="mb-2">Indicator</label>
                                <select name="indicator" class="form-select">
                                    <option value="0" selected>Digital</option>
                                    <option value="1">Physical</option>
                                </select>
                            </div>
                            @error('indicator')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div id="priceInput" style="display: none;" class="form-group mt-3">
                                <label for="price" class="mb-2">Price</label>
                                <input type="number" name="price" id="price" class="form-control"
                                    placeholder="Price">
                            </div>
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group mt-3">
                                <label for="" class="mb-2">Description</label>
                                <textarea type="text" name="description" class="form-control" placeholder="Description"></textarea>
                            </div>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-coreui-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.0.0-rc.1/dist/js/coreui.bundle.min.js"
        integrity="sha384-lm/gmE8U/6Q0duWGAHKfdf8Q0rLLWtCudgbt9aLBgnb5B+iateMBMTOBGSafJbEe" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        document.getElementById('formFileMultiple').onchange = function() {
            const fileInput = document.getElementById('formFileMultiple');
            const textBox = document.querySelector('.upload-box p');

            let totalFileCount = 0; // Variable to store the total count of files

            if (fileInput.files && fileInput.files.length > 0) {
                // Calculate the total count of files by adding previously selected files and new files
                totalFileCount += fileInput.files.length;
            }

            if (totalFileCount > 0) {
                textBox.textContent = totalFileCount + " files selected";
            } else {
                textBox.textContent = "Click to upload files";
            }
        };
        $(document).ready(function() {
            $('#sale').change(function() {
                if ($(this).find(':selected').attr('id') === 'for-sale') {
                    $('#priceInput').show();
                } else {
                    $('#priceInput').hide();
                }
            });
        });

        function myFunction() {
            var element = document.body;
            element.dataset.coreuiTheme =
                element.dataset.coreuiTheme == "light" ? "dark" : "light";
            if (element.dataset.coreuiTheme == "dark") {
                DarkReader.enable();
            } else {
                DarkReader.disable();
            }
        }
    </script>
</body>

</html>
