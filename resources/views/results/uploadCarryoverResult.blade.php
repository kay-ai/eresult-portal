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
                        <div class="row">
                            <div class="col-md-3">
                                <label for="level" class="form-label">Level</label>
                                <select name="level" class="form-control" required="required">
                                    <option>- Select a Level</option>
                                    @if ($levels)
                                        @foreach ($levels as $rec):
                                           <option value="{{$rec->id}}">{{$rec['name']}}</option>
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
                                <label for="csv" class="form-label">Select CSV File</label>
                                <input type="file" name="csv" required="required" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn d-block btn-second" style="width: 100%; margin-top:30px">
                                    {{ __('Upload Result') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection
