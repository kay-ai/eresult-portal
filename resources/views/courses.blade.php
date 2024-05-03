@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">

		<div class="col-md-4">
		    <h2 class="text-center">Add Course</h2>
			<form method="post" action="">
			    <div class="form-group">
			        <label>Title</label>
			        <input type="text" name="name" required="required" class="form-control">
			    </div>

			    <div class="form-group">
			        <label>Code</label>
			        <input type="text" name="code" required="required" class="form-control">
			    </div>

			    <div class="form-group">
			        <label>Unit</label>
			        <select name="unit" class="form-select" required="required">
			            <option value="1">1 Unit</option>
			            <option value="2">2 Units</option>
			            <option value="3">3 Units</option>
			            <option value="4">4 Units</option>
			            <option value="5">5 Units</option>
			            <option value="6">6 Units</option>
			        </select>
			    </div>

			    <div class="form-group">
			        <label>Level</label>
			        <select name="level" class="form-select" required="required">
			            <option></option>
			            <?php
			            if($levels):
			            	foreach($levels as $rec):
			            		echo '<option value="'.$rec['id'].'">'.$rec['name'].'</option>';
			            	endforeach;
			            endif;
			            ?>
			        </select>
			    </div>

			    <div class="form-group">
			        <label>Type</label>
			        <select name="type" class="form-select" required="required">
			            <option value="Core">Core Course</option>
			            <option value="Elective">Elective</option>
			        </select>
			    </div>

			    <div class="form-group">
			        <label>Semester Offered</label>
			        <select name="semester" class="form-select" required="required">
			            <option value="First">First Semester</option>
			            <option value="Second">Second Semester</option>
			        </select>
			    </div>

			    <div class="form-group mt-3">
			        <input type="submit" name="addCourse" value="Register" class="tgt-full-width w3-btn w3-green w3-text-white">
			    </div>

			</form>
    	</div>

		<div class="col-md-8">
		    <h2 class="text-center">Registered Courses</h2>

			<table class="table table-sm table-stripped" style="font-size: 12px">
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
					<?php
					if(count($data) > 0):
						foreach($data as $key => $val):
							echo '<tr>
								<td>'.($key+1).'</td>
								<td>'.$val['title'].'</td>
								<td>'.$val['code'].'</td>
								<td>'.$val['unit'].'</td>
								<td>'.$val['type'].'</td>
								<td>'.$val['semester'].'</td>
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
