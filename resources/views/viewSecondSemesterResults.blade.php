@extends('layouts.result')

@section('content')

<div id="div1">
	<div class="full-width padded bg-white">

<?php
	if(isset($_POST['load'])){
	  $session = $_POST['session'];
	  $semester = $_POST['semester'];
	  $level = $_POST['level'];

	  $_SESSION['semester'] = $semester;
		$_SESSION['session'] = $session;
		$_SESSION['level'] = $level;
	}else{
		//print '<script>history.back();</script>';
	}

  if($semester === "First"){
    print '<script>location.assign("viewresult.php");</script>';
    exit();
  }

	$semester = $_SESSION['semester'];
	$session = $_SESSION['session'];
	$level = $_SESSION['level'];

	print '<span class="full-width"><h2 class="center">Result for '.$level.' Level, '.$semester.' Semester, Session: '.$session.'</h2></span>';

	print '<table width="100%" border="1" cellpadding="1" cellspacing="1" style="font-size: 70%">
  <tr>
    <th scope="col">S/N</th>
    <th scope="col">Full Name </th>
    <th scope="col">Matric Num </th>
    <th scope="col">

	    <table style="width:100%" border="1" cellspacing="1" cellpadding="1">
	      <tr>
	        <th scope="col" style="text-align: center; width: 72.6%">Current Semester </th>
	      </tr>
	      <tr>
	        <td style="text-align: center" style="width: 72.6%">Core Courses </td>
	        <td style="width: 6.6%">TCR</td>
	        <td style="width: 6.6%">TCE</td>
	        <td style="width: 6.6%">TGP</td>
	        <td style="width: 6.6%">GPA</td>

          <td style="width: 6.6%">Prev GPA</td>
          <td style="width: 6.6%">CGPA</td>

	      </tr>
	    </table>

    </th>
    <th scope="col">Remarks</th>
  </tr>';

	$sql = "SELECT * FROM results WHERE session = '$session' AND semester = '$semester' AND level = '$level' ORDER BY id DESC";
	$x = 0;

	if($db->countRows($sql) > 0){

		$res = $db->getData($sql);

		foreach($res as $r){
			$x++;
			$cc1 = $r['cc1'];
			$g1 = $r['grade1'];
      $mn = $r['mat_num'];
      $gp = $r['gpa'];
      $cgpa = getStdntCGPA($db,$mn, $level, $gp);
      $pgpa = prevGpa($db,$mn, $level);
      $remarks = $r['remarks'];

      if($remarks == "0"){
        $remarks = "";
      }else{
        $remarks = $r['remarks'];
      }

			print '<tr>
    <th scope="col">'.$x.'</th>
    <th scope="col"></th>
    <th scope="col">'.$r['mat_num'].'</th>
    <th scope="col">

    <table border="1" style="width:100%" cellspacing="1" cellpadding="1">
      <tr>
        <td style="width: 6.6%">'.$r['cc1'].'<br>'.$r['cu1'].'</td>
        <td style="width: 6.6%">'.$r['cc2'].'<br>'.$r['cu2'].'</td>
        <td style="width: 6.6%">'.$r['cc3'].'<br>'.$r['cu3'].'</td>
        <td style="width: 6.6%">'.$r['cc4'].'<br>'.$r['cu4'].'</td>
        <td style="width: 6.6%">'.$r['cc5'].'<br>'.$r['cu5'].'</td>
        <td style="width: 6.6%">'.$r['cc6'].'<br>'.$r['cu6'].'</td>
        <td style="width: 6.6%">'.$r['cc7'].'<br>'.$r['cu7'].'</td>
        <td style="width: 6.6%">'.$r['cc8'].'<br>'.$r['cu8'].'</td>
        <td style="width: 6.6%"'.$r['cc9'].'<br>'.$r['cu9'].'</td>
        <td style="width: 6.6%">'.$r['cc10'].'<br>'.$r['cu10'].'</td>
        <td style="width: 6.6%">'.$r['cc11'].'<br>'.$r['cu11'].'</td>
        <td style="width: 6.6%">56</td>
        <td style="width: 6.6%">'.$r['tcu'].'</td>
        <td style="width: 6.6%">'.$r['tgp'].'</td>
        <td style="width: 6.6%">'.$r['gpa'].'</td>

        <td style="width: 6.6%">'.$pgpa.'</td>
        <td style="width: 6.6%">'.$cgpa.'</td>

      </tr>
      <tr>
        <td style="width: 6.6%">'.$r['score1'].''.$r['grade1'].'</td>
        <td style="width: 6.6%">'.$r['score2'].''.$r['grade2'].'</td>
        <td style="width: 6.6%">'.$r['score3'].''.$r['grade3'].'</td>
        <td style="width: 6.6%">'.$r['score4'].''.$r['grade4'].'</td>
        <td style="width: 6.6%">'.$r['score5'].''.$r['grade5'].'</td>
        <td style="width: 6.6%">'.$r['score6'].''.$r['grade6'].'</td>
        <td style="width: 6.6%">'.$r['score7'].''.$r['grade7'].'</td>
        <td style="width: 6.6%">'.$r['score8'].''.$r['grade8'].'</td>
        <td style="width: 6.6%">'.$r['score9'].''.$r['grade9'].'</td>
        <td style="width: 6.6%">'.$r['score10'].''.$r['grade10'].'</td>
        <td style="width: 6.6%">'.$r['score11'].''.$r['grade11'].'</td>
      </tr>
    </table></th>

    <th scope="col">'.str_replace("0","", $remarks).'</th>
  </tr>';
		}

	}else{
		print '<tr><td colspan="10">No data found...</td></tr>';
		//print $db->connection_error($sql);
	}

	print '</table>';
?>
</div>
</div>

<div class="full-width">
  <div class="centered"><button onclick="myprint('div1')" style="padding: 5px 8px; border: 1px solid lightblue; border-radius: 5px; background: blue; color: white">
        <b><i class="fa fa-print"></i>&nbsp;Print</b>
        </button></div>
</div>

@endsection
