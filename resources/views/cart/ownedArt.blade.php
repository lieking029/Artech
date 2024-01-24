@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card m-3" style="background-color: black">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4 class="text-white m-2">Owned Art</h4>
            </div>
        </div>
        <div class="card-body">
            @foreach ($ownedArts as $ownedArt)
                    <div class="row mt-3">
                        <div class="col-2">
                            <img src="{{ asset('storage/' . $ownedArt->art->artImages->first()->image) }}" alt=""
                                style="width:100%; height:200px;">
                        </div>
                        <div class="col-7">
                            <h4 class="text-white">{{ $ownedArt->art->category->name }}</h4>
                            <h5 class="text-white">{{ $ownedArt->art->title }}</h5>
                            <p class="text-white">{{ $ownedArt->art->description }}</p>
                            <label for="" class="text-white">Price:
                                {{ number_format($ownedArt->art->price, 2, '.', ',') }}</label>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</div>
@endsection