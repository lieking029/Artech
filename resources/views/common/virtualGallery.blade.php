@extends('layouts.app')

@section('content')
    <style>
        .zoomable-image-container {
            max-height: 700px;
            overflow: hidden;
        }

        .zoomable-image {
            border: 2px solid #242526;
            width: 100%;
            height: auto;
        }

        /* Define fixed sizes for the profile image */
        .profile-image {
            width: 50px;
            /* Fixed width */
            height: 50px;
            /* Fixed height */
        }

        @media screen and (max-width: 768px) {

            /* Adjust font size for smaller screens */
            .container label {
                font-size: 12px;
                /* Change this to your desired smaller font size */
            }

            /* Adjust profile image size for smaller screens */
            .profile-image {
                width: 40px;
                /* Change this to your desired smaller image width */
                height: 40px;
                /* Change this to your desired smaller image height */
            }

            /* Adjust title, description, forsale and price for smaller screens */
            .title,
            .description,
            .forsale,
            .price .category {
                font-size: 12px;
                /* Change this to your desired smaller font size */
            }

            .zoomable-image-container {
                max-height: 400px;
                /* Adjust the maximum height for smaller screens */
            }
        }
    </style>

    @php
        $currentDateTime = now(); // Get the current date and time
        $oneHourAgo = $currentDateTime->copy()->subHours(1); // Calculate 1 hour ago

        // Filter arts created within the last hour
        $latestArts = $arts->filter(function ($art) use ($oneHourAgo) {
            return $art->created_at->gt($oneHourAgo);
        });

        // Get older arts (older than 1 hour)
        $olderArts = $arts->reject(function ($art) use ($oneHourAgo) {
            return $art->created_at->gt($oneHourAgo);
        });

        // Shuffle older arts randomly
        $shuffledOlderArts = $olderArts->shuffle();

        // Combine the latest arts with shuffled older arts
        $combinedArts = $latestArts->concat($shuffledOlderArts);
    @endphp

    <div class="container-fluid">
        <div class="container-fluid" style="width: 100%;">
            @foreach ($combinedArts as $art)
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <div class="d-flex justify-content-end mt-4 mb-3">
                            <div class="container">
                                <img src="{{ asset('icons/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg') }}"
                                    alt="img" class="rounded-circle profile-image">
                                <label class="text-white mx-2">{{ $art->user->name }}</label>
                                <label for="" class="text-white">• {{ $art->created_at->diffForHumans() }}</label>
                            </div>
                            <h6 class="text-white mx-4 mt-3 category" style=" white-space: nowrap;">
                                {{ $art->category->name }}</h6>
                        </div>
                        <div class="carousel-inner">
                            @foreach ($art->artImages as $index => $artImage)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="zoomable-image-container">
                                        <img src="{{ asset('storage/' . $artImage->image) }}" alt=""
                                            data-id="{{ $art->id }}" class="zoomable-image"
                                            id="artBtn_{{ $index }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex mt-3 justify-content-between mx-2 me-2">
                            <div class="">
                                <span class="like-container" data-art-id="{{ $art->id }}"
                                    data-liked="{{ $art->likes->where('user_id', auth()->id())->count() > 0 ? 'true' : 'false' }}"
                                    style="cursor: pointer;">
                                    <i class="{{ $art->likes->where('user_id', auth()->id())->count() > 0 ? 'fas' : 'far' }} fa-star text-white star-icon"
                                        id="starIcon_{{ $art->id }}" style="font-size: 25px"></i>
                                    <span class="text-white like-count">{{ $art->likes->count() }}</span>
                                </span>
                                <a href="{{ url('chatify/' . $art->user->id) }}"><i class="far fa-comment text-white mx-2"
                                        style="font-size: 25px"></i></a>
                            </div>
                            <div class="price">
                                <label for="" class="text-white">
                                    @if ($art->sale == 1)
                                        @if ($art->price == 0)
                                            For Sale
                                        @else
                                            For Sale ₱ {{ number_format($art->price, 2, '.', ',') }}
                                            <button class="addToCart btn" style="background-color: white"
                                                data-art-id="{{ $art->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon-tabler icon-tabler-shopping-cart text-black" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M17 17h-11v-14h-2" />
                                                    <path d="M6 5l14 1l-1 7h-13" />
                                                </svg>
                                            </button>
                                        @endif
                                    @elseif ($art->sale == 3)
                                        Sold
                                    @else
                                        Not For Sale
                                    @endif
                            </div>
                        </div>
                        <h5 for="" class="text-white mt-2 title">{{ $art->title }}</h5>
                        <p class="text-white m-2 description">{{ $art->description }}</p>
                        <hr class="text-white">
                    </div>
                </div>
            @endforeach
        </div>

        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content text-white" style="background: #0C0C18">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Image Gallery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex my-2" style="margin-left: 30px">
                            <img src="https://scontent.fmnl25-4.fna.fbcdn.net/v/t39.30808-6/316541946_876752107083217_5841789909563890176_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=efb6e6&_nc_eui2=AeHp6OL09d2UfnUuFcRlp8baIdqJpC8rMSgh2omkLysxKCdoRpbmZRyInp5_zCnXNT8QmYMTBdoAECcciFLtEg89&_nc_ohc=AfNqmO1ixXgAX_D9JHD&_nc_ht=scontent.fmnl25-4.fna&oh=00_AfBTpkbKN3x42b0z_XpMt3ONMYMZMKywAmFhzUodGbtpDQ&oe=657DAE5B"
                                height="50" width="50" class="rounded-circle" />
                            <h5 style="margin-left: 20px" class="text-white py-2" id="name"></h5>
                        </div>
                        <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- END MODAL --}}

    <script>
        $(document).ready(function() {
            function toggleStarIconShading(starIcon) {
                if (starIcon.hasClass('far')) {
                    starIcon.removeClass('far').addClass('fas');
                } else {
                    starIcon.removeClass('fas').addClass('far');
                }
            }

            $('.like-container').on('click', function() {
                const artId = $(this).data('art-id');
                const starIcon = $(`#starIcon_${artId}`);

                toggleStarIconShading(starIcon); // Toggle star icon's shading

                $.ajax({
                    url: `/like/${artId}`, // Replace with your Laravel route
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Include CSRF token for security
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        // Revert the star icon's shading if there's an error with the AJAX call
                        toggleStarIconShading(starIcon);
                    }
                });
            });

            $('.addToCart').on('click', function() {
                const artId = $(this).data('art-id');

                $.ajax({
                    url: `/add/${artId}`, // corrected 'artId' variable instead of 'art-id' string
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        console.log('add to cart');
                    },
                    error: function(xhr, status, error) {
                        // Handle error if the item couldn't be added to the cart
                        console.error('Error adding item to cart:', error);
                        // You can show an error message or take appropriate action
                    }
                });
            });

        });

        document.addEventListener('DOMContentLoaded', function() {
            var likeContainers = document.querySelectorAll('.like-container');

            likeContainers.forEach(function(container) {
                container.addEventListener('click', function() {
                    var likeCountSpan = this.querySelector('.like-count');
                    var liked = this.getAttribute('data-liked') === 'true';
                    var currentLikeCount = parseInt(likeCountSpan.textContent);

                    if (liked) {
                        // Decrease the like count by 1 if it was previously liked
                        var updatedLikeCount = currentLikeCount - 1;
                        likeCountSpan.textContent = updatedLikeCount;
                        this.setAttribute('data-liked', 'false'); // Toggle liked status
                    } else {
                        // Increase the like count by 1 if it wasn't previously liked
                        var updatedLikeCount = currentLikeCount + 1;
                        likeCountSpan.textContent = updatedLikeCount;
                        this.setAttribute('data-liked', 'true'); // Toggle liked status
                    }
                });
            });
        });
    </script>
@endsection
