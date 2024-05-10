@extends('layouts.app', [($activePage = 'results')])

@section('content')
<div class="me-2">
    <div class="row mt-4">

		<div class="col-md-12">
		    <h2 class="text-center">Add Course</h2>
			<form method="post" action="{{route('course.create')}}">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <label>Title</label>
                        <input type="text" name="title" required="required" class="form-control">
                    </div>

                    <div class="col-md-2">
                        <label>Code</label>
                        <input type="text" name="code" required="required" class="form-control">
                    </div>

                    <div class="col-md-1">
                        <label>Unit</label>
                        <select name="unit" class="form-control form-select" required="required">
                            <option value="1">1 Unit</option>
                            <option value="2">2 Units</option>
                            <option value="3">3 Units</option>
                            <option value="4">4 Units</option>
                            <option value="5">5 Units</option>
                            <option value="6">6 Units</option>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <label>Level</label>
                        <select name="level" class="form-control form-select" required="required">
                            <option></option>
                            @if($levels)
                                @foreach($levels as $rec)
                                    <option value="{{$rec->id}}">{{$rec->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label>Type</label>
                        <select name="type" class="form-control form-select" required="required">
                            <option value="Core">Core Course</option>
                            <option value="Elective">Elective</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label>Semester Offered</label>
                        <select name="semester" class="form-control form-select" required="required">
                            <option value="First">First Semester</option>
                            <option value="Second">Second Semester</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group mt-4">
                            <input type="submit" value="Register" class="btn btn-info">
                        </div>
                    </div>

                </div>
			</form>
    	</div>

		<div class="col-md-12 mt-4">

		    <h2 class="text-center">Registered Courses</h2>

			<table class="table table-sm datatable-benpoly" style="font-size: 12px">
				<thead>
				    <tr>
				        <th>#</th>
				        <th>Title</th>
				        <th>Code</th>
				        <th>Unit</th>
				        <th>Type</th>
				        <th>Semester</th>
				        <th>Level</th>
				        <th>Date&nbsp;Added</th>
				        <th>Action</th>
				    </tr>
				</thead>
				<tbody>
					@if($courses)
						@foreach($courses as $key => $val)
							<tr>
								<td>{{($key+1)}}</td>
								<td>{{$val->title}}</td>
								<td>{{$val->code}}</td>
								<td>{{$val->unit}}</td>
								<td>{{$val->type}}</td>
								<td>{{$val->semester}}</td>
								<td>{{$val->level->name}}</td>
								<td>{{$val->created_at}}</td>
								<td><button class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button></td>
							</tr>
						@endforeach
					@endif
				</tbody>
			</table>

		</div>

	</div>
</div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#users_table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endpush
