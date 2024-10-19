@extends('layouts.app', [($activePage = 'All Results')])

@section('content')
    <div class="me-2">
        <div class="row mt-4">

            <div class="col-md-12">
                <div class="card shadow-sm p-3">
                    <p class="text-kdis-2 mb-3 subheader">Query Results</p>
                    <form method="post" action="{{route('results.view')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="level" class="form-label">Department</label>
                                <select name="department_id" class="form-control" required="required">
                                    <option>- Select a Department -</option>
                                    @if ($departments)
                                        @foreach ($departments as $rec):
                                           <option value="{{$rec->id}}">{{$rec->name}}</option>
                                        @endforeach;
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="level" class="form-label">Academic Session</label>
                                <select name="session_id" class="form-control" required="required">
                                    <option>- Select a Session -</option>
                                    @if ($sessions)
                                        @foreach ($sessions as $rec):
                                           <option value="{{$rec->id}}">{{$rec->title}}</option>
                                        @endforeach;
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="level" class="form-label">Level</label>
                                <select name="level_id" class="form-control" required="required">
                                    <option>- Select a Level -</option>
                                    @if ($levels)
                                        @foreach ($levels as $rec):
                                           <option value="{{$rec->id}}">{{$rec->name}}</option>
                                        @endforeach;
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="semester" class="form-label">Semester</label>
                                <select name="semester" class="form-control" required="required">
                                    <option>- Select Semester -</option>
                                    <option value="First">First Semester</option>
                                    <option value="Second">Second Semester</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn d-block btn-second" onclick="fetchStudents();" style="width: 100%; margin-top:30px">
                                    {{ __('View Results') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
