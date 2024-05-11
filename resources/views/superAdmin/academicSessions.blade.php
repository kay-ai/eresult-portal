@extends('layouts.app', [($activePage = 'Academic Session')])

@section('content')
    <div class="me-2">
        <div class="row mt-4">

            <div class="col-md-4">
                <div class="card p-3 shadow-sm">
                    <p class="text-kdis-2 mb-3 subheader">Create Session</p>
                    <form method="post" action="{{route('sessions.create')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" required="required" placeholder="2024/2025" class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" value="Create"
                                class="btn btn-second">
                        </div>

                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card p-3 shadow-sm">
                    <p class="text-kdis-2 mb-3 subheader">All Sessions</p>
                    <table class="table table-sm table-stripped" style="font-size: 12px">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($sessions)
                                @foreach ($sessions as $key => $val)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $val->title }}</td>
                                        <td>{{ $val->created_at }}</td>
                                        <td class="action-btn">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="">
                                                <button class="btn btn-sm btn-kdis"><i class='bx bx-show-alt'></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
