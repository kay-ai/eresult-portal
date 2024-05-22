@extends('layouts.app', [($activePage = 'Schools')])

@section('content')
    <div class="me-2">
        <div class="row mt-4">

            <div class="col-md-4">
                <div class="card p-3 shadow-sm">
                    <p class="text-kdis-2 mb-3 subheader">Create School</p>
                    <form method="post" action="{{route('faculty.create')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" required="required" placeholder="SCHOOL OF ENGINEERING" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Dean</label>
                            <input type="text" name="dean" required="required" placeholder="Enter Name of Dean" class="form-control">
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
                    <p class="text-kdis-2 mb-3 subheader">All School</p>
                    <table class="table table-sm table-stripped" style="font-size: 12px">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Dean</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($faculties)
                                @foreach ($faculties as $key => $val)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $val->name }}</td>
                                        <td>{{ $val->dean }}</td>
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
                                <th>Dean</th>
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
