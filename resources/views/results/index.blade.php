@extends('layouts.app', [($activePage = 'All Results')])

@section('content')
    <div class="me-2">
        <div class="row mt-4">

            <div class="col-md-12">
                <div class="card shadow-sm p-3">
                    <p class="text-kdis-2 mb-3 subheader">Query Results</p>
                    <form method="post" action="">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="level" class="form-label">Level</label>
                                <select name="level" class="form-control" required="required">
                                    <option>- Select a Level -</option>
                                    @if ($levels)
                                        @foreach ($levels as $rec):
                                           <option value="{{$rec->id}}">{{$rec['name']}}</option>
                                        @endforeach;
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="semester" class="form-label">Semester</label>
                                <select name="semester" class="form-control" required="required">
                                    <option>- Select an Option -</option>
                                    <option value="First">First Semester</option>
                                    <option value="Second">Second Semester</option>
                                </select>
                            </div>
                            <div class="col-md-4">
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
