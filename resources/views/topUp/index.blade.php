@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('topUp.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="card mt-3" style="background-color: black">
                <div class="card-header">
                    <h4 class="text-white">Top Up</h4>
                    <div class="text-end">
                        <a href="{{route('table')}}" class="btn btn-primary">Status</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group d-flex flex-column align-items-center">
                        <label for="" class="text-white">Scan Here to Top Up</label>
                        <div class="">
                            <img src="{{ asset('icons/gcash.jpg') }}" alt="" srcset=""
                                style="width:400px; height:400px;">
                        </div>
                        <div class="">
                            <label for="" class="text-white">Amount</label>
                            <input type="number" placeholder="Amount" name="amount" class="form-control"
                                style="width: 600px">
                        </div>
                        <div class="mt-3">
                            <label for="" class="text-white">Image</label>
                            <input type="file" placeholder="Amount" name="image" class="form-control"
                                style="width: 600px" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a class="btn btn-secondary mx-2" type="submit" href="{{ route('home') }}">Cancel</a>
                    <button class="btn btn-primary mx-3" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
