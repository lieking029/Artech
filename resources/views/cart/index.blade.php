@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card m-3" style="background-color: black">
            <div class="card-header">
                <h4 class="text-white m-2">Cart</h4>
            </div>
            <div class="card-body">
                @foreach ($carts as $cart)
                    <div class="row">
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
                            <button class="btn btn-primary mt-5" style="width: 200px">Buy</button>
                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger mt-3 text-white" style="width: 200px"
                                    type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
