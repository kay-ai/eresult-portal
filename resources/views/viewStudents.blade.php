@extends('layouts.app')

@section('content')

<div class="w3-container" style="overflow:auto">

    <?php

    if(isset($_POST['viewStdBtn'])){

	    $cat = $_POST['cat'];

	    $_SESSION['cat'] = $cat;

    }else{
        $cat = $_SESSION['cat'];
    }

	?>
    <div id="printable">
    <h2 class="tgt-center"><?=$cat;?> Students' List</h2>

		<table class="w3-table-responsive w3-stripped tgt-left table-row-out" style="font-size: 10px" border="1">
		    <tr class="w3-green">
		        <th>#</th>
		        <th>Reg.&nbsp;Number</th>
		        <th>First&nbsp;Name</th>
		        <th>Middle&nbsp;Name</th>
		        <th>Last&nbsp;Name</th>
		        <th>Age</th>
		        <th>Sex</th>
		        <th>State</th>
		        <th>LGA</th>
		        <th>Phone</th>
		        <th>Email</th>
		        <th>Mode of Study</th>
		        <th>Category</th>
		        <th>Department</th>
		        <th>Course</th>
		        <th>Year</th>
		    </tr>
		    <?php

		    if(isset($_POST['viewStdBtn'])){
		        $cat = $_POST['cat'];

		        $_SESSION['cat'] = $cat;

		        $year = $_POST['session'];

		        $_SESSION['year'] = $year;

		        if($cat === "Fresh"){
		            displayFreshStudents($db,$cat,$year);
		        }else{
		            $dept = $_POST['dept'];
		            $_SESSION['dept'] = $dept;
		            displayStudents($db,$cat,$year,$dept);
		        }
		    }else{
		        $cat = $_SESSION['cat'];
		        $year = $_SESSION['year'];
		        if($cat === "Fresh"){
		            displayFreshStudents($db,$cat,$year);
		        }else{
		            $dept = $_SESSION['dept'];
		            displayStudents($db,$cat,$year,$dept);
		        }
		    }

		    ?>
		</table>
    </div>
    <!--end of printable-->
    <div class="tgt-full-width tgt-center">
            <button onclick="myprint('printable')" class="w3-btn w3-green w3-text-white">
            <b><i class="fa fa-print"></i>&nbsp;Print</b>
            </button>

            <button class="w3-btn w3-blue w3-text-white" onclick="javascript:location.assign('studentList.php?action=<?=$cat;?>');">Back</button>
        </div>
</div>
<!--end of w3-container-->
<script>
    function myprint(div){
    	var restore = document.body.innerHTML;
    	var printcontent = document.getElementById(div).innerHTML;
    	document.body.innerHTML = printcontent;
    	window.print();
    	document.body.innerHTML = restore;
	}
</script>

@endsection
