@extends('layouts.app', [($activePage = 'results')])

@section('content')
    <div class="me-2">
        <div class="row mt-4">

            <div class="col-md-12">
                <h3>Query Results</h3>
                <div class="card border-0 shadow p-3 mb-4 mt-4">
                    <form method="post" action="{{route('results.view')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="session" class="form-label">Academic Session</label>
                                <select name="session_id" class="form-control" required="required">
                                    <option></option>
                                    @if ($sessions)
                                        @foreach ($sessions as $rec):
                                           <option value="{{$rec->id}}">{{$rec->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="level" class="form-label">Level</label>
                                <select name="level_id" class="form-control" required="required">
                                    <option></option>
                                    @if ($levels)
                                        @foreach ($levels as $rec):
                                           <option value="{{$rec->id}}">{{$rec->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="semester" class="form-label">Semester</label>
                                <select name="semester" class="form-control" required="required">
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
