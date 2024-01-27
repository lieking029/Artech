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

    <div class="container-fluid">
        <div class="container-fluid" style="width: 100%;">
            @foreach ($arts->sortBy('created_at') as $art)
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <div class="d-flex justify-content-end mt-4 mb-3">
                            <div class="container">
                                @if ($art->user->profile)
                                    <img src="{{ asset('storage/' . $art->user->profile) }}" alt="img"
                                        class="rounded-circle profile-image">
                                @else
                                    <img src="{{ asset('icons/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg') }}"
                                        alt="img" class="rounded-circle profile-image">
                                @endif
                                <label class="mx-2" style="color: inherit;">{{ $art->user->name }}</label>
                                <label for="" style="color: inherit;">• {{ $art->created_at->diffForHumans() }}</label>
                            </div>
                            <h6 class="mx-4 mt-3 category" style=" white-space: nowrap; color: inherit;">
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
                            <div class="d-flex">
                                <span class="like-container" data-art-id="{{ $art->id }}"
                                    data-liked="{{ $art->likes->where('user_id', auth()->id())->count() > 0 ? 'true' : 'false' }}"
                                    style="cursor: pointer;">
                                    <i class="{{ $art->likes->where('user_id', auth()->id())->count() > 0 ? 'fas' : 'far' }} fa-star star-icon"
                                        id="starIcon_{{ $art->id }}" style="font-size: 25px; color: inherit;"></i>
                                    <span class="like-count">{{ $art->likes->count() }}</span>
                                </span>
                                <button style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;"
                                    data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $art->id }}"
                                    class="edit-button">
                                    <i class="fas fa-pen mx-2" style="font-size: 25px; color: inherit;"></i>
                                </button>
                                <form method="POST" action="{{ route('art.sold', $art->id) }}">
                                    @csrf
                                    <button type="submit"
                                        style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                        <i class="fas fa-money-bill mx-2" style="font-size: 25px; color: inherit;"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('mypost.destroy', $art->id) }}">
                                    @csrf
                                    <button type="submit"
                                        style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;">
                                        <i class="fas fa-trash mx-2" style="font-size: 25px; color: inherit;"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="price">
                                <label for="" style="color: inherit;">
                                    @if ($art->sale == 1)
                                        @if ($art->price == 0)
                                            For Sale
                                        @else
                                            For Sale ₱ {{ number_format($art->price, 2, '.', ',') }}
                                        @endif
                                    @elseif ($art->sale == 3)
                                        Sold
                                    @else
                                        Not For Sale
                                    @endif
                            </div>
                        </div>
                        <h5 for="" class="mt-2 title" style="color: inherit;">{{ $art->title }}</h5>
                        <p class="m-2 description" style="color: inherit;">{{ $art->description }}</p>
                        <hr class="text-white">
                    </div>
                </div>
            @endforeach
        </div>

        {{-- MODAL --}}

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

    {{-- MODAL --}}
    @if ($arts->isNotEmpty())
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-white" style="background: #242526">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create</h5>
                        <a class="btn-close" href="{{ route('mypost.index') }}"></a>
                    </div>
                    <form action="{{ route('art.update', '__ID__') }}" method="POST" enctype="multipart/form-data"
                        id="editForm">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="" class="mb-2">Art Category</label>
                                <select name="category_id" id="editCategory" class="form-select">
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
                                <input type="text" placeholder="Title" name="title" class="form-control"
                                    id="editTitle">
                            </div>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group mt-3">
                                <label for="image" class="mb-2">Your ART</label>
                                <div class="upload-box" onclick="document.getElementById('formFileMultiple').click();">
                                    <p>Click to upload files</p>
                                </div>
                                <input class="form-control d-none" name="image[]" type="file" id="formFileMultiple"
                                    multiple>
                            </div>
                            @error('image.*')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group mt-3">
                                <label for="sale" class="mb-2" id="editSale">Sale</label>
                                <select name="sale" id="sale" class="form-select">
                                    <option id="not-for-sale" value="0" selected>Not For Sale</option>
                                    <option id="for-sale" value="1">For Sale</option>
                                </select>
                            </div>
                            @error('sale')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div id="priceInput" style="display: none;" class="form-group mt-3">
                                <label for="price" class="mb-2">Price</label>
                                <input type="number" name="price" id="price" class="form-control"
                                    placeholder="Price" id="editPrice" value="{{ $art->price }}">
                            </div>
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group mt-3">
                                <label for="" class="mb-2">Description</label>
                                <textarea type="text" name="description" class="form-control" placeholder="Description" id="editDescription"></textarea>
                            </div>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" href="{{ route('mypost.index') }}">Close</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- END MODAL --}}

    <script>
        // JavaScript to dynamically set the action attribute of the form based on the clicked button
        document.addEventListener('DOMContentLoaded', function() {
            var editModal = new bootstrap.Modal(document.getElementById('editModal'));

            // Event listener for the edit button click
            $('.edit-button').on('click', function() {
                var artId = $(this).data('id');
                var editFormAction = '{{ route('art.update', '__ID__') }}';
                editFormAction = editFormAction.replace('__ID__', artId);

                // Set the action attribute of the form dynamically
                $('#editForm').attr('action', editFormAction);

                // Show the modal
                editModal.show();
            });
        });
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

        $(document).ready(function() {
            $('.edit-button').click(function() {
                var artId = $(this).data('id');

                // Ajax request to fetch art details
                $.ajax({
                    url: '/artValue/' + artId,
                    type: 'GET',
                    success: function(data) {
                        // Update modal form fields with fetched data
                        $('#editTitle').val(data.title);
                        $('#editCategory').val(data.category_id);
                        // Set the selected sale option based on data.sale
                        if (data.sale === 1) {
                            $('#sale').val('1'); // 'For Sale'
                            $('#priceInput').show();
                        } else {
                            $('#sale').val('0'); // 'Not For Sale'
                        }
                        $('#editDescription').val(data.description);

                        // Show the modal
                        $('#editModal').modal('show');
                        console.log(data)
                    },
                    error: function() {
                        alert('Error fetching art details.');
                    }
                });
            });
        });
    </script>
@endsection
