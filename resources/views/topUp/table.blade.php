@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card mt-3" style="background-color: white">
            <div class="card-header">
                <h4>Top Up</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" style="background-color: white">
                        <thead>
                            <tr>
                                <td>Image</td>
                                <td>Amount</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topUps as $topUp)
                                <tr>
                                    <td><img src="{{ 'storage/' . $topUp->image }}" alt="" srcset=""
                                            style="width: 300px; height: 300px;"></td>
                                    <td>{{ $topUp->amount }}</td>
                                    <td class="d-flex">
                                        @admin
                                            <form action="{{ route('table.accept', $topUp->user_id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-primary text-white mx-3"><strong>Accept</strong></button>
                                            </form>
                                            <form action="{{ route('table.reject', $topUp->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-danger text-white"><strong>Reject</strong></button>
                                            </form>
                                        @endadmin
                                    </td>
                                </tr>
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
