@extends('layouts.app', [($activePage = 'Course Performances')])

@section('content')
    <div class="me-2">
        <div class="row mt-4">
            <div class="col-md-12 mt-2">
                <p style="font-weight: 500">{{$department->name}} | {{$semester.' Semester'}} | {{$session->title. ' Session'}}</p>
            </div>
            <div class="col-md-12 mt-2">
                <div class="card shadow-sm p-3">
                    <p class="text-kdis-2 mb-3 subheader">Result Statistics</p>

                    <table class="table table-striped table-responsive datatable-benpoly">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Code</th>
                                <th>Course Title</th>
                                <th>Max Mark</th>
                                <th>Min Mark</th>
                                <th>Number of Students</th>
                                <th>Number Passed</th>
                                <th>Number Failed</th>
                                <th>Number Absent</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($courseStat as $stat)
                                <tr>
                                    <td scope="row">{{$stat['code']}}</td>
                                    <td>{{$stat['title']}}</td>
                                    <td>{{$stat['max']}}</td>
                                    <td>{{$stat['min']}}</td>
                                    <td>{{$stat['students_no']}}</td>
                                    <td>{{$stat['no_passed'] ?? '-'}}</td>
                                    <td>{{$stat['no_failed'] ?? '-'}}</td>
                                    <td>{{$stat['no_absent'] ?? '-'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
