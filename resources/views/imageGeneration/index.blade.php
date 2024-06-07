@extends('layouts.app')

@section('content')
    <style>
        .search-container {
            position: relative;
            width: 100%;
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 15px;
        }

        .search-box {
            width: 100%;
            padding: 10px 35px 10px 15px;
            border-radius: 25px;
            border: 1px solid #ccc;
            outline: none;
        }

        /* Style for the search icon */
        .search-box-container {
            position: relative;
        }

        .search-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            font-size: 18px;
            color: #888;
            cursor: pointer;
            background: none;
            /* Add this line to remove the background */
            border: none;
            /* Optionally, remove the border if present */
        }

        /* Adjust SVG size for the icon */
        .search-icon svg {
            width: 24px;
            heigh: 24px
        }

        #loading-indicator {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            /* Centers the spinner */
            z-index: 1000;
            /* Ensures it's on top of other content */
        }
    </style>
    <div id="loading-indicator" style="display: none;">
        <i class="fas fa-spinner fa-spin fa-2x"></i>
    </div>
    <div class="container-fluid">
        <form method="GET">
            <div class="search-container">
                <div class="search-box-container">
                    <input type="search" class="search-box" placeholder="Search" name="prompt"
                        value="{{ request('prompt') }}">
                    <button class="search-icon" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2">
                        <label for="" class="text-white">Size</label>
                        <select name="size" id="" class="form-select">
                            <option value="256x256">256x256</option>
                            <option value="512x512">512x512</option>
                            <option value="1024x1024">1024x1024</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <label for="" class="text-white">Pictures</label>
                        <select name="picture" id="" class="form-select">
                            <option value="3">3</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <hr>
        @foreach ($imageUrl as $image)
            <div class="d-flex flex-column align-items-center">
                <img src="{{ $image }}" alt="" class="mt-3">
            </div>
        @endforeach
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form').submit(function() {
                $('#loading-indicator').show();
                $(document).ajaxComplete(function() {
                    $('#loading-indicator').hide();
                });
            });
        });
    </script>
@endsection
