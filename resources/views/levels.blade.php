@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">

		<div class="col-md-4">
		    <h2 class="text-center">Add Level</h2>
			<form method="post" action="">
			    <div class="form-group">
			        <label>Name</label>
			        <input type="text" name="name" required="required" class="form-control">
			    </div>

			    <div class="form-group mt-3">
			        <input type="submit" name="addLevel" value="Create" class="tgt-full-width w3-btn w3-green w3-text-white">
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
					<?php
					if($data):
						foreach($data as $key => $val):
							echo '<tr>
								<td>'.($key+1).'</td>
								<td>'.$val['name'].'</td>
								<td>'.$val['created_at'].'</td>
								<td><button><i class="fa fa-eye"></i></button></td>
							</tr>';
						endforeach;
					endif;
					?>
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
