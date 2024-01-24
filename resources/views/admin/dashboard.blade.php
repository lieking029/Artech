@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5">
        <div class="card-header text-white">
            <h3>ADMIN DASHBOARD</h3>
        </div>

        <div class="row mt-5">

            <div class="col-md-4">
                <div class="text-white rounded-4 mb-4 p-4" style="background: #242526">
                    <div class="card-body">
                        <h2 class="card-title">{{ $clients }} Clients</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="text-white rounded-4 mb-4 p-4" style="background: #242526">
                    <div class="card-body">
                        <h2 class="card-title"> {{ $artsUploaded }} Approved Arts</h2>
                        <p class="card-text">View and manage all approved art post</p>
                        <a href="{{ route('art.index') }}" class="btn text-white" style=" background: #7b7d7f;">View Virtual Gallery</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class=" mb-4 p-4 text-white rounded-4 " style="background: #242526">
                    <div class="card-body">
                        <h2 class="card-title">{{ $artsPending }} Pending Arts</h2>
                        <p class="card-text">View and manage all pending art post</p>
                        <a href="{{ route('art.index') }}" class="btn text-white" style=" background: #7b7d7f;">View Pending
                            Arts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
