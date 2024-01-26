@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <form id="checkoutForm" action="{{ route('buy', $cart->art->id) }}" method="POST">
            @csrf
            <div class="card mt-3" style="background-color: black">
                <div class="card-header">
                    <h4 class="text-white">Checkout</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ asset('storage/' . $cart->art->artImages->first()->image) }}" alt=""
                                style="width:100%; max-height:700px;">
                        </div>
                        <div class="col-4">
                            <h1 class="text-white">{{ $cart->art->category->name }}</h1>
                            <h4 class="text-white">{{ $cart->art->title }}</h4>
                            <p class="text-white">{{ $cart->art->description }}</p>
                            <h4 class="text-white">Price: ₱{{ number_format($cart->art->price, 2, '.', ',') }}</h4>
                        </div>
                        <div class="col-4">
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-footer d-flex justify-content-end">
                    <a class="btn btn-secondary mx-3 mb-3" style="width: 300px" href="{{ route('cart.index') }}">Cancel</a>
                    @if (auth()->user()->wallet >= $cart->art->price)
                        <button class="btn btn-primary mb-3" style="width: 300px" type="submit">Buy</button>
                    @else
                        <button class="btn btn-primary mb-3" style="width: 300px" type="button" onclick="notEnoughBalance()">Buy</button>
                    @endif
                    <a class="btn btn-success mb-3 mx-3" style="width: 300px"
                        href="{{ url('chatify/' . $cart->art->user->id) }}">Chat with them</a>
                </div>
            </div>
        </form>
    </div>
    <script>
        function notEnoughBalance() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'You do not have enough balance to make this purchase!',
            });
        }
    </script>
@endsection
