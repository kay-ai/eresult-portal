@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row">

		<div class="col-md-4">
		    <h2 class="text-center">Create Session</h2>
			<form method="post" action="" enctype="multipart/form-data">
			    <div class="form-group">
			        <label>Title</label>
			        <input type="text" name="title" required="required" class="form-control">
			    </div>

			    <div class="form-group">
			        <label>HOD</label>
			        <input type="text" name="hod_name" required="required" class="form-control">
			    </div>

			    <div class="form-group">
			        <label>Signature</label>
			        <input type="file" name="signature" required="required" class="form-control">
			    </div>

			    <div class="form-group mt-3">
			        <input type="submit" name="createSession" value="Create" class="tgt-full-width w3-btn w3-green w3-text-white">
			    </div>

			</form>
    	</div>

		<div class="col-md-8">
		    <h2 class="text-center">All Sessions</h2>

			<table class="table table-sm table-stripped" style="font-size: 12px">
				<thead>
				    <tr>
				        <th>#</th>
				        <th>Title</th>
				        <th>HOD</th>
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
							<td>'.$val['title'].'</td>
							<td>'.$val['hod'].'</td>
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
