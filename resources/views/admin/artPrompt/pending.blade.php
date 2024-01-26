@extends('layouts.app')

@section('content')
    <style>
        .dataTables_length label {
            color: white;
        }

        .dataTables_length select {
            color: white;
        }

        #dataTable_filter label {
            color: white;
        }

        #dataTable_filter input {
            color: white;
        }

        #dataTable_info {
            color: white;
        }
    </style>

    <div class="container-fluid mt-5">
        <h3 class="text-white">Pending Posts</h3>
        <div class="card-body mt-5 text-white">
            <table class="table-responsive text-white">
                <table class="table table-dark table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>Art Photo</th>
                            <th>User</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arts as $art)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $art->artImages->first()->image) }}" height="100"
                                        width="100" alt="" class="img-thumbnail art-image" data-toggle="modal"
                                        data-target="#artModal" style="cursor: pointer;">
                                </td>
                                <td>{{ $art->user->name }}</td>
                                <td>{{ $art->title }}</td>
                                <td>
                                    <a href="{{ route('art.approved', $art->id) }}" class="btn btn-success">Approve</a>
                                    <a href="{{ route('art.disapproved', $art->id) }}" class="btn btn-danger">Disapprove</a>
                                </td>
                            </tr>
                            <div class="modal fade" id="artModal" tabindex="-1" role="dialog"
                                aria-labelledby="artModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img src="{{ asset('storage/' . $art->artImages->first()->image) }}"
                                                id="fullScreenImage" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Modal -->

                    </tbody>
                </table>
            </table>
        </div>
        <script>
            $('#dataTable').DataTable();
            $('.art-image').on('click', function() {
                var imageUrl = $(this).attr('src');
                $('#fullScreenImage').attr('src', imageUrl);
            });
        </script>
    </div>
@endsection
