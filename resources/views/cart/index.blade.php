@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card m-3" style="background-color: black">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="text-white m-2">Cart</h4>
                    <a href="{{ route('owned', auth()->user()->id) }}" class="btn btn-primary">Owned Art</a>
                </div>
            </div>
            <div class="card-body">
                @foreach ($carts as $cart)
                    @if ($cart->art->sale === 1)
                        <div class="row mt-3">
                            <div class="col-2">
                                <img src="{{ asset('storage/' . $cart->art->artImages->first()->image) }}" alt=""
                                    style="width:100%; height:200px;">
                            </div>
                            <div class="col-7">
                                <h4 class="text-white">{{ $cart->art->category->name }}</h4>
                                <h5 class="text-white">{{ $cart->art->title }}</h5>
                                <p class="text-white">{{ $cart->art->description }}</p>
                                <label for="" class="text-white">Price:
                                    {{ number_format($cart->art->price, 2, '.', ',') }}</label>
                            </div>
                            <div class="col">
                                <a class="btn btn-primary mt-5" style="width: 200px"
                                    href="{{ route('cart.checkout', $cart->id) }}">Buy</a>
                                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger mt-3 text-white" style="width: 200px"
                                        type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
