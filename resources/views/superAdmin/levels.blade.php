@extends('layouts.app', [($activePage = 'Levels')])

@section('content')
<div class="container-fluid py-4">
    <div class="row">

		<div class="col-md-4 mb-3">
            <div class="card p-3 shadow-sm">
		    <p class="text-kdis-2 mb-3 subheader">Add Level</p>
			<form method="post" action="{{route('levels.create')}}">
                @csrf
			    <div class="form-group">
			        <label>Name</label>
			        <input type="text" name="name" required="required" placeholder="400" class="form-control">
			    </div>

			    <div class="form-group mt-3">
			        <input type="submit" value="Create" class="btn btn-second">
			    </div>
			</form>
            </div>
    	</div>

		<div class="col-md-8">
            <div class="card p-3 shadow-sm">
                <p class="text-kdis-2 mb-3 subheader">All Levels</p>
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
