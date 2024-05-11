@extends('layouts.app', [($activePage = 'Create Faculties')])

@section('content')
    <div class="me-2">
        <div class="row mt-4">

            <div class="col-md-4">
                <h4 class="text-center">Create Faculty</h4>
                <form method="post" action="{{route('faculty.create')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" required="required" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Dean</label>
                        <input type="text" name="dean" required="required" class="form-control">
                    </div>

                    <div class="form-group mt-3">
                        <input type="submit" value="Create"
                            class="btn btn-success">
                    </div>

                </form>
            </div>

            <div class="col-md-8">

                <h4 class="text-center">All Faculties</h4>

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
                                    <td><button class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button></td>
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
@endsection
