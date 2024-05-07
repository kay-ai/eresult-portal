<div class="row">

	<div class="col-md-4">
	    <h2 class="text-center">Query Students</h2>
		<form method="post" action="" onsubmit="event.preventDefault();">
		    <div class="form-group">
		        <label>Session</label>
		        <select name="session" id="session" required="required" class="form-control">
		            <option></option>
		            <?php
		            if($sessions):
		            	foreach($sessions as $rec):
		            		echo '<option value="'.$rec['id'].'">'.$rec['title'].'</option>';
		            	endforeach;
		            endif;
		            ?>
		        </select>
		    </div>

		    <div class="form-group">
		        <label>Semester Offered</label>
		        <select name="semester" id="semester" class="form-select" required="required">
		            <option value="First">First Semester</option>
		            <option value="Second">Second Semester</option>
		        </select>
		    </div>

		    <div class="form-group">
		    	<label>Level</label>
		    	<select name="level" id="level" class="form-select">
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

		    <div class="form-group mt-3">
		        <input type="submit" name="viewStd" id="viewStdBtn" onclick="fetchStudents();" value="View List" class="tgt-full-width w3-btn w3-green w3-text-white">
		    </div>

		</form>
	</div>

	<div class="col-md-8">
	    <h2 class="text-center">Students List</h2>
		<table class="table table-stripped table-responsive" style="font-size: 12px">
			<thead>
			    <tr>
			        <th>#</th>
			        <th>Mat.&nbsp;Number</th>
			        <th>First&nbsp;Name</th>
			        <th>Middle&nbsp;Name</th>
			        <th>Last&nbsp;Name</th>
			        <th>Level</th>
			        <th>Session</th>
			        <th>Action</th>
			    </tr>
			</thead>
			<tbody id="viewStudents">

			</tbody>
		</table>
	</div>

</div>
