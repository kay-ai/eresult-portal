@extends('layouts.app', [($activePage = 'Grades')])

@section('content')
<div class="container-fluid py-4">
    <div class="row">

		<div class="col-md-4">
		    <h2 class="text-center">Add Grade</h2>
			<form method="post" action="">
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
			        <input type="submit" name="addGrade" value="Create" class="btn btn-primary">
			    </div>

			</form>
    	</div>

		<div class="col-md-8">
		    <h2 class="text-center">All Grades</h2>

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
								<td><button><i class="fa fa-eye"></i></button></td>
							</tr>
						@endforeach
					@endif
				</tbody>
			</table>

		</div>

	</div>
</div>
@endsection
