@extends('layouts.app')

@section('content')

<div class="container-fluid w-75 mt-5">
    <div class="card-body p-3 rounded-4" style="background: #242526; margin-left: 20px">
        <div class="text-center d-flex">
            <img height="50" width="50" class="rounded-circle me-2" src="https://scontent.fmnl25-4.fna.fbcdn.net/v/t39.30808-6/316541946_876752107083217_5841789909563890176_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=efb6e6&_nc_eui2=AeHp6OL09d2UfnUuFcRlp8baIdqJpC8rMSgh2omkLysxKCdoRpbmZRyInp5_zCnXNT8QmYMTBdoAECcciFLtEg89&_nc_ohc=AfNqmO1ixXgAX_D9JHD&_nc_ht=scontent.fmnl25-4.fna&oh=00_AfC61hKA4qZnlZ3yukql07W1JsMpr7YYhufo3oUaHVlzSg&oe=657BB41B" alt="">
            <button type="button" class="form-control btn rounded-5 text-start text-white" style="background: #3A3B3C"  data-coreui-toggle="modal" data-coreui-target="#exampleModal">
                <strong style="margin-left: 20px">Add your MASTERPIECE</strong>
            </button>
        </div>
        <hr style="color: rgb(174, 174, 174)">
        <div class="row text-center">
            <div class="col">
                <a href="{{ route('my-post.index') }}" class="btn" style="color: #7b7d7f"><strong>My Post</strong></a>
            </div>
            <div class="col">
                <a href="" class="btn" style="color: #7b7d7f"><strong>My Messages</strong></a>
            </div>
        </div>
    </div>
        <div class="row my-5">
            @foreach ($arts as $art)
            <div class="col-3">
                <img
                src="{{ asset('storage/' . $art->artImages->first()->image) }}"
                alt=""
                data-id="{{ $art->id }}"
                style="border: 2px solid #242526"
                height="300"
                width="300"
                id="artBtn">
            </div>
            @endforeach
        </div>


        {{-- MODAL --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  >
            <div class="modal-dialog modal-dialog-centered" >
              <div class="modal-content text-white" style="background: #242526">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add your ART</h5>
                  <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="@admin {{ route('art.admin') }} @endadmin @client {{ route('art.store') }} @endclient" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mt-3">
                          <label for="">Art Category</label>
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
                          <label for="">Art Title</label>
                          <input type="text" placeholder="Title" name="title" class="form-control">
                        </div>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group mt-3">
                          <label for="">Your ART</label>
                          <input type="file" name="image[]" class="form-control" multiple>
                        </div>
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                </form>
              </div>
            </div>
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
                            <img src="https://scontent.fmnl25-4.fna.fbcdn.net/v/t39.30808-6/316541946_876752107083217_5841789909563890176_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=efb6e6&_nc_eui2=AeHp6OL09d2UfnUuFcRlp8baIdqJpC8rMSgh2omkLysxKCdoRpbmZRyInp5_zCnXNT8QmYMTBdoAECcciFLtEg89&_nc_ohc=AfNqmO1ixXgAX_D9JHD&_nc_ht=scontent.fmnl25-4.fna&oh=00_AfBTpkbKN3x42b0z_XpMt3ONMYMZMKywAmFhzUodGbtpDQ&oe=657DAE5B" height="50" width="50" class="rounded-circle" />
                            <h5 style="margin-left: 20px" class="text-white py-2" id="name"></h5>
                        </div>
                                <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
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

          {{-- END MODAL --}}

<script>
        const baseUrl = '{{ url('') }}';
        $('#artBtn').click(function () {
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
</div>
@endsection


