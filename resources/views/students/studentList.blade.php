@extends('layouts.app', [($activePage = 'All Students')])

@section('content')
    <div class="me-2">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-sm p-3 mb-4">
                    <form method="post" action="" onsubmit="event.preventDefault();">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="session" class="form-label">Academic Session: </label>
                                <select name="session" class="form-control @error('session') is-invalid @enderror" id=""required autocomplete="session" autofocus>
                                    <option>- Select an Option -</option>
                                    @if ($sessions)
                                        @foreach ($sessions as $session)
                                            <option value="{{$session->id}}">{{$session->title}}</option>
                                        @endforeach
                                    @endif
                                </select>

                                @error('session')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="semester" class="form-label">Semester: </label>
                                <select name="semester" class="form-control @error('semester') is-invalid @enderror" id=""required autocomplete="semester" autofocus>
                                    <option>- Select an Option -</option>
                                    <option value="first">First Semester</option>
                                    <option value="second">Second Semester</option>
                                </select>

                                @error('semester')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="level" class="form-label">Level: </label>
                                <select name="level" class="form-control @error('level') is-invalid @enderror" id="" required autocomplete="level" autofocus>
                                    <option>- Select an Option -</option>
                                    <option value="first">First level</option>
                                    <option value="second">Second level</option>
                                </select>

                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn d-block btn-second" onclick="fetchStudents();" style="width: 100%; margin-top:30px">
                                    {{ __('Fetch Students') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card shadow-sm p-3">
                    <h5 class="text-kdis-2">Students</h5>
                    <table class="table datatable-benpoly" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mat. Number</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Level</th>
                                <th>Session</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="viewStudents">
                            @if($students)
                                @foreach($students as $key => $student)
                                <tr>
                                    <td>{{($key+1)}}</td>
                                    <td>{{$student->mat_num}}</td>
                                    <td>{{$student->fname}}</td>
                                    <td>{{$student->mname}}</td>
                                    <td>{{$student->lname}}</td>
                                    <td>{{$student->gender}}</td>
                                    <td>{{$student->level->name}}</td>
                                    <td>{{$student->academicSession->title}}</td>
                                    <td>
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
                                <th>Mat. Number</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Level</th>
                                <th>Session</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
