@extends('layouts.app', [($activePage = 'Exam Officer')])

@section('content')
    <div class="me-2">
        <div class="row mt-4">

            <div class="col-md-4">
                <h4 class="text-center">Add Exam Officer</h4>
                <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Users</label>
                        <select name="user" required="required" class="form-select">
                            <option></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Department</label>
                        <select name="department" required="required" class="form-control">
                            <option></option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <input type="submit" value="Add Exam Officer"
                            class="btn btn-success">
                    </div>

                </form>
            </div>

            <div class="col-md-8">

                <h4 class="text-center">Exam Officers</h4>

                <table class="table table-sm table-stripped" style="font-size: 12px">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Date Added</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($examOfficers)
                            @foreach ($examOfficers as $key => $val)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $val->user->name }}</td>
                                    <td>{{ $val->department->title }}</td>
                                    <td>{{ $val->created_at }}</td>
                                    <td><button><i class="fa fa-eye"></i></button></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Date Added</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>

            </div>

        </div>
    </div>
@endsection
