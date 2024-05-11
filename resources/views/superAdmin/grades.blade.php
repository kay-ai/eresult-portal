@extends('layouts.app', [($activePage = 'Grades')])

@section('content')
<div class="container-fluid py-4">
    <div class="row">

		<div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <p class="text-kdis-2 mb-3 subheader">Add Grade</p>
                <form method="post" action="{{route('grades.create')}}">
                    @csrf
                    <div class="form-group">
                        <label>Type</label>
                        <input type="text" name="type" required="required" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>From</label>
                        <input type="number" name="from" required="required" step="0.01" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>To</label>
                        <input type="number" name="to" required="required" step="0.01" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Remark</label>
                        <input type="text" name="rmk" required="required" class="form-control">
                    </div>

                    <div class="form-group mt-3">
                        <input type="submit" value="Create" class="btn btn-second">
                    </div>

                </form>
            </div>
    	</div>

		<div class="col-md-8">
            <div class="card p-3 shadow-sm">
                <p class="text-kdis-2 mb-3 subheader">All Grades</p>
                <table class="table table-sm table-stripped" style="font-size: 12px">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Range</th>
                            <th>Remark</th>
                            <th>Date Added</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($grades)
                            @foreach($grades as $key => $val)
                                <tr>
                                    <td>{{($key+1)}}</td>
                                    <td>{{$val->_type}}</td>
                                    <td>{{$val->_from}} - {{$val->_to}}</td>
                                    <td>{{$val->rmk}}</td>
                                    <td>{{$val->created_at}}</td>
                                    <td class="action-btn">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="">
                                            <button class="btn btn-sm btn-kdis"><i class='bx bx-show-alt'></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
		</div>

	</div>
</div>
@endsection
