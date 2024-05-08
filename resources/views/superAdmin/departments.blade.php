@extends('layouts.app', [($activePage = 'Create Department')])

@section('content')
    <div class="me-2">
        <div class="row mt-4">

            <div class="col-md-4">
                <h4 class="text-center">Create Department</h4>
                <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" required="required" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>HOD</label>
                        <input type="text" name="hod_name" required="required" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Signature</label>
                        <input type="file" name="signature" required="required" class="form-control">
                    </div>

                    <div class="form-group mt-3">
                        <input type="submit" name="createSession" value="Create"
                            class="btn btn-success">
                    </div>

                </form>
            </div>

            <div class="col-md-8">

                <h4 class="text-center">All Departments</h4>

                <table class="table table-sm table-stripped" style="font-size: 12px">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>HOD</th>
                            <th>Date Added</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($departments)
                            @foreach ($departments as $key => $val)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $val->title }}</td>
                                    <td>{{ $val->hod }}</td>
                                    <td>{{ $val->created_at }}</td>
                                    <td><button><i class="fa fa-eye"></i></button></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>HOD</th>
                            <th>Date Added</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>

            </div>

        </div>
    </div>
@endsection
