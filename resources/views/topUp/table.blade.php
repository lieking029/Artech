@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mt-3">
            <div class="card-header">
                <h4>Top Up</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <td>Image</td>
                                <td>Amount</td>
                                <td>Status</td>
                                @admin
                                    <td>Action</td>
                                @else
                                @endadmin
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topUps as $topUp)
                                @if(auth()->user()->hasRole('admin'))
                                    @if($topUp->status <= 1 || $topUp->user_id == auth()->id())
                                        <tr>
                                            <td>
                                                <img src="{{ 'storage/' . $topUp->image }}" alt="" srcset=""
                                                    style="width: 300px; height: 300px;">
                                            </td>
                                            <td>{{ $topUp->amount }}</td>
                                            <td>
                                                @if ($topUp->status == 2)
                                                    Success
                                                @elseif($topUp->status == 3)
                                                    Rejected
                                                @elseif($topUp->status == 0)
                                                    Pending
                                                @endif
                                            </td>
                                            @admin
                                                @if($topUp->status <= 1)
                                                    <td class="d-flex">
                                                        <form action="{{ route('table.accept', $topUp->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-primary text-white mx-3"><strong>Accept</strong></button>
                                                        </form>
                                                        <form action="{{ route('table.reject', $topUp->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger text-white"><strong>Reject</strong></button>
                                                        </form>
                                                    </td>
                                                @endif
                                            @endadmin
                                        </tr>
                                    @endif
                                @elseif($topUp->user_id == auth()->id())
                                    <tr>
                                        <td>
                                            <img src="{{ 'storage/' . $topUp->image }}" alt="" srcset=""
                                                style="width: 300px; height: 300px;">
                                        </td>
                                        <td>{{ $topUp->amount }}</td>
                                        <td>
                                            @if ($topUp->status == 2)
                                                Success
                                            @elseif($topUp->status == 3)
                                                Rejected
                                            @elseif($topUp->status == 0)
                                                Pending
                                            @endif
                                        </td>
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
