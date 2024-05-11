@extends('layouts.app', [($activePage = 'Exam Officer')])

@section('content')
    <div class="me-2">
        <div class="row mt-4">

            <div class="col-md-4">
                <h4 class="text-center">Add Exam Officer</h4>
                <form method="post" action="{{route('exam-officers.create')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Users</label>
                        <select name="user_id" required="required" class="form-select">
                            <option></option>
                            @if($users)
                                @foreach($users as $key => $user)
                                <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Department</label>
                        <select name="department_id" required="required" class="form-control">
                            <option></option>
                            @if($departments)
                                @foreach($departments as $key => $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            @endif
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
                                    <td>{{ $val->user->first_name }} {{ $val->user->last_name }}</td>
                                    <td>{{ $val->department->name }}</td>
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
