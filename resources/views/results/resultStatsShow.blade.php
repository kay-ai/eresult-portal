@extends('layouts.app', [($activePage = 'Results Stats')])

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
                                <th>Mat Number</th>
                                <th>Full Name</th>
                                <th>Level</th>
                                <th>Number Passed</th>
                                <th>Number Failed</th>
                                <th>Number Absent</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($resultStat as $stat)
                                <tr>
                                    <td scope="row">{{$stat['mat_num']}}</td>
                                    <td>{{$stat['full_name']}}</td>
                                    <td>{{$stat['level']}}</td>
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
