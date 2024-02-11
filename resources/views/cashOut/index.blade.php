@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mt-3">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <td>User</td>
                                <td>Amount</td>
                                <td>Status</td>
                                <td>Wallet</td>
                                <td>Gcash Number</td>
                                @admin
                                    <td>Action</td>
                                @endadmin
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cashout as $cash)
                                @if (auth()->user()->hasRole('admin') || $cash->user_id === auth()->user()->id)
                                    <tr>
                                        <td>{{ $cash->user->name }}</td>
                                        <td>{{ $cash->cashout }}</td>
                                        <td>
                                            @if ($cash->status == 2)
                                                Success
                                            @elseif($cash->status == 3)
                                                Rejected
                                            @elseif($cash->status == 0)
                                                Pending
                                            @endif
                                        </td>
                                        <td>{{ $cash->user->wallet }}</td>
                                        <td>{{ $cash->number }}</td>
                                        @admin
                                            <td>
                                                <a href="{{ route('cashout.reject', $cash->id) }}"
                                                    class="btn btn-danger">Reject</a>
                                                <a href="{{ route('cashout.accept', $cash->id) }}"
                                                    class="btn btn-primary">Accept</a>
                                            </td>
                                        @endadmin
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
