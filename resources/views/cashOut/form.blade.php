@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid">
        <form action="{{ route('request.cashout') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    Cash Out
                    <div class="text-end">
                        <a href="{{ route('cashout.table') }}" class="btn btn-primary">Status</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Cash Out Amount</label>
                        <input type="number" class="form-control" name="cashout">
                    </div>
                    <div class="form-group">
                        <label for="">Gcash Number</label>
                        <input type="number" class="form-control" name="number">
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
