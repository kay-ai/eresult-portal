@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
    	<div class="col-md-4 p-3 m-auto text-center">
		    <a href="<?=url('assets/app-contents/docs/studentsListCsvSample.csv');?>" download><button class="w3-btn w3-blue w3-text-white">Download CSV Template</button></a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 m-auto">
		    <h2 class="text-center">Upload Students' List</h2>
			<form method="post" action="" enctype="multipart/form-data">
			    <div class="tgt-form-group">
			        <label>Select CSV File</label>
			        <input type="file" name="csv" required="required" class="form-control">
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
			        <label>Semester</label>
			        <select name="semester" class="form-select" required="required">
			            <option value="First">First Semester</option>
			            <option value="Second">Second Semester</option>
			        </select>
			    </div>

			    <div class="tgt-form-group mt-3">
			        <input type="submit" name="uploadCsvList" value="Upload List" class="tgt-full-width w3-btn w3-green w3-text-white">
			    </div>

			</form>
		</div>
	</div>
</div>

@endsection
