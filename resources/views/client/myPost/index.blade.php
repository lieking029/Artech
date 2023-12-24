@extends('layouts.app')

@section('content')

<div class="container-fluid w-75 mt-5">
    <h3 class="text-white">My Post</h3>
        @foreach ($arts as $art)
        <div class="card-body my-4 py-4 rounded-4 text-center" style="background: #242526">
            <img style="max-height: 856px; max-width: 800px" class="rounded-4" src="{{ asset('storage/' . $art->image) }}" alt="">
            <br> <br>
            <div class="text-start" style="border-bottom: 1px solid rgb(174, 174, 174); border-top: 1px solid rgb(174, 174, 174)">
              <button style="width: 100%; background: #242526; color: #7b7d7f; padding-left: 40px" class="btn border-0 text-start py-2 my-2" type="submit">
                <i class="fas fa-thumbs-up"></i> <strong>{{ $art->likes?->count() }}</strong> Like(s)
            </button>
            </div>
        </div>
        @endforeach
</div>
@endsection
