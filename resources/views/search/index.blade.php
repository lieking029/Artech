@extends('layouts.app')

@section('content')
    <style>
        /* Existing styles for the search container and input field */
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
            height: 24px;
        }

        .image-container {
            max-width: 250px;
            width: 100%;
            max-height: 250px;
            height: 100%;
            /* Set maximum height */
            overflow: hidden;
            /* Hide overflowing parts */
        }

        .overflow-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        /* Responsive CSS using media queries */
        @media (max-width: 576px) {
            .image-container {
                max-width: 180px;
                width: 100%;
                max-height: 180px;
                height: 100%;
                /* Set maximum height */
                overflow: hidden;
                /* Hide overflowing parts */
            }

            .overflow-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }
    </style>

    <div class="container-fluid">
        <form action="{{ route('search.index') }}" method="GET">
            @csrf
            <div class="search-container">
                <div class="search-box-container">
                    <input type="search" class="search-box" placeholder="Search" name="art" value="{{ $search }}">
                    <button class="search-icon" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="filter-container">
                <h5 class="text-white">Filters</h5>
                <div class="row">
                    <div class="col-2">
                        <label for="saleSelect" class="text-white">Sale</label>
                        <select name="saleSelect" id="saleSelect" class="form-select">
                            <option value="" class="form-control" disabled>Select</option>
                            <option value="0" {{ request('saleSelect') === '0' ? 'selected' : '' }}>Not For Sale
                            </option>
                            <option value="1" {{ request('saleSelect') === '1' ? 'selected' : '' }}>Sale</option>
                        </select>
                    </div>
                    <div class="col-2" id="rangeContainer"
                        style="{{ request('saleSelect') === '1' ? '' : 'display: none;' }}">
                        <label for="selectRange" class="text-white">Range</label>
                        <select name="selectRange" class="form-select">
                            <option value="all" {{ request('selectRange') === 'all' ? 'selected' : '' }}>All</option>
                            <option value="0-3000" {{ request('selectRange') === '0-3000' ? 'selected' : '' }}>₱ 0 - 3000
                            </option>
                            <option value="3000-above" {{ request('selectRange') === '3000-above' ? 'selected' : '' }}>₱
                                3000 - Above</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <hr>
        <div class="row">
            @foreach ($arts as $art)
                <div class="col-6 col-md-6 col-lg-2 mt-3">
                    <div class="image-container">
                        <img src="{{ asset('storage/' . $art->artImages->first()->image) }}" alt="img"
                            class="overflow-image">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        document.getElementById('saleSelect').addEventListener('change', function() {
            var selectedValue = this.value;
            var rangeContainer = document.getElementById('rangeContainer');
            var saleRange = document.getElementById('saleRange');

            // Show or hide the range container based on the selection
            if (selectedValue === '1') {
                rangeContainer.style.display = 'block';
            } else {
                rangeContainer.style.display = 'none';
                saleRange.value = 0; // Reset range value if not 'Sale' is selected
            }
        });
        
        const baseUrl = '{{ url('') }}';
        $('#artBtn').click(function() {
            fetch(baseUrl + '/art/' + $(this).data('id'))
                .then(response => response.json())
                .then(art => {
                    // console.log(art); // Log the entire art object to the console

                    // Check if art has artImages and it is an array
                    if (art.art_images && Array.isArray(art.art_images)) {
                        // Call the openModal function after updating the form
                        // console.log(art.art_images)
                        openModal(art);
                    } else {
                        console.error('ArtImages is not an array or is undefined');
                    }
                });
        });

        function openModal(art) {
            // Get the carousel element
            var carouselInner = document.querySelector('#imageCarousel .carousel-inner');

            const basePath = '{{ asset('storage') }}';
            // Clear existing carousel items
            carouselInner.innerHTML = '';

            // document.getElementById('profile').src = basePath + '/' + art.user.profile;
            document.getElementById('name').textContent = art.user.name

            // Populate the carousel with images from artImages
            art.art_images.forEach(function(artImage, index) {
                var carouselItem = document.createElement('div');
                carouselItem.classList.add('carousel-item');

                // Add 'active' class to the first carousel item
                if (index === 0) {
                    carouselItem.classList.add('active');
                }

                const image = document.createElement('img');
                image.classList.add('d-block', 'w-100');
                image.style.height = '80vh';
                image.src = basePath + '/' + artImage.image;

                carouselItem.appendChild(image);
                carouselInner.appendChild(carouselItem);

                // Debugging: Log image source to the console
                console.log('Image Source:', image.src);
            });

            // Initialize the Bootstrap Carousel after adding items
            const myCarousel = new bootstrap.Carousel(carouselInner);

            // Show the modal
            const myModal = new bootstrap.Modal(document.getElementById('imageModal'));
            myModal.show();
        }
    </script>
@endsection
