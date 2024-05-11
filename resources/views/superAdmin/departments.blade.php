@extends('layouts.app', [($activePage = 'Departments')])

@section('content')
    <div class="me-2">
        <div class="row mt-4">

            <div class="col-md-4">
                <div class="card p-3 shadow-sm">
                    <p class="text-kdis-2 mb-3 subheader">Create Department</p>
                    <form method="post" action="{{route('departments.create')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="name" required="required" placeholder="SCHOOL OF ENGINEERING TECHNOLOGY" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>HOD</label>
                            <input type="text" name="hod" required="required" placeholder="Enter HOD Name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Faculty</label>
                            <select name="faculty_id" class="form-control" required="required">
                                <option>- Select an Option -</option>
                                @if($faculties)
                                    @foreach($faculties as $faculty)
                                    <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Signature</label>
                            <input type="file" name="signature" required="required" class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" name="createSession" value="Create"
                                class="btn btn-second">
                        </div>

                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card p-3 shadow-sm">
                    <p class="text-kdis-2 mb-3 subheader">All Departments</p>
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
                                        <td>{{ $val->name }}</td>
                                        <td>{{ $val->hod }}</td>
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
    </div>
@endsection
