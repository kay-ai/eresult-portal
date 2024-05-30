@extends('layouts.app', [($activePage = 'Upload Results')])

@section('content')
    <div class="me-2">
        <a href="{{asset('docs/results-temp.csv')}}" download>
            <button class="btn btn-first">Download Results CSV Template</button>
        </a>
        <div class="row mt-4">

            <div class="col-md-12">
                <div class="card shadow-sm p-3">
                    <p class="text-kdis-2 mb-3 subheader">Upload Carryover Results</p>
                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="row pe-2">
                            <div class="col-md-3 p-3">
                                <label for="csv" class="form-label">Select CSV File</label>
                                <input type="file" name="csv" required="required" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            </div>
                            <div class="col-md-9 shadow-sm p-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="session" class="form-label">Academic Session: </label>
                                        <select name="session_id" class="form-control @error('session') is-invalid @enderror" id=""required autocomplete="session" autofocus>
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
                                            <option value="First">First Semester</option>
                                            <option value="Second">Second Semester</option>
                                        </select>

                                        @error('semester')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="level_id" class="form-label">Level: </label>
                                        <select name="level_id" class="form-control @error('level') is-invalid @enderror" id="" required autocomplete="level" autofocus>
                                            <option>- Select an Option -</option>
                                            @if ($levels)
                                                @foreach ($levels as $level)
                                                    <option value="{{$level->id}}">{{$level->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @error('level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="department_id" class="form-label">Department: </label>
                                        <select name="department_id" class="form-control @error('level') is-invalid @enderror" id="" required autocomplete="level" autofocus>
                                            <option>- Select an Option -</option>
                                            @if ($departments)
                                                @foreach ($departments as $department)
                                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @error('level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                    <button type="submit" class="btn d-block btn-second" style="width: 100%; margin-top:20px">
                                        {{ __('Upload Result Sheet') }}
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection
