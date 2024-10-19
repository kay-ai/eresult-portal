@extends('layouts.app', [($activePage = 'Transcript')])

@section('content')
    <div class="me-2">
        <div class="row mt-4">

            <div class="col-md-12">
                <div class="card shadow-sm p-3">
                    <p class="text-kdis-2 mb-3 subheader">Query Transcript</p>
                    <form method="post" action="{{route('results.transcript.show')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="department" class="form-label">Department</label>
                                <select name="department_id" class="form-control" required="required">
                                    <option>- Select a department -</option>
                                    @if ($departments)
                                        @foreach ($departments as $rec):
                                           <option value="{{$rec->id}}">{{$rec->name}}</option>
                                        @endforeach;
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="level" class="form-label">Matric Number</label>
                                <input name="mat_num" class="form-control" required="required">
                            </div>
                            <div class="col-md-2">
                                <button class="btn d-block btn-second" type="submit" style="width: 100%; margin-top:30px" role="button">
                                    {{ __('View Transcript') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
