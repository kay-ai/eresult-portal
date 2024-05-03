<div class="container-fluid py-4">
    <div class="row">

    	<div class="col-md-6 m-auto">
		    <h2 class="text-center">Query Results</h2>
				<form method="post" action="">

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
			        <input type="submit" name="viewResultBtn" value="View Results" class="tgt-full-width w3-btn w3-green w3-text-white">
			    </div>

				</form>
		</div>
	</div>
</div>
