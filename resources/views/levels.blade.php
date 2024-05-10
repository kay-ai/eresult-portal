@extends('layouts.app', [($activePage = 'Levels')])

@section('content')
<div class="container-fluid py-4">
    <div class="row">

		<div class="col-md-4 mb-3">
		    <h2 class="text-center">Add Level</h2>
			<form method="post" action="{{route('levels.create')}}">
                @csrf
			    <div class="form-group">
			        <label>Name</label>
			        <input type="text" name="name" required="required" class="form-control">
			    </div>

			    <div class="form-group mt-3">
			        <input type="submit" value="Create" class="btn btn-secondary">
			    </div>

			</form>
    	</div>

		<div class="col-md-8">
		    <h2 class="text-center">All Levels</h2>

			<table class="table table-sm table-stripped" style="font-size: 12px">
				<thead>
				    <tr>
				        <th>#</th>
				        <th>Name</th>
				        <th>Date Added</th>
				        <th>Action</th>
				    </tr>
				</thead>
				<tbody>

					@if($levels)
						@foreach($levels as $key => $val)
							<tr>
								<td>{{($key+1)}}</td>
								<td>{{$val['name']}}</td>
								<td>{{$val['created_at']}}</td>
								<td>
									<button class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button>
								</td>
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
