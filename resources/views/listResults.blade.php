<?php
session_start();
include_once("../src/dbCon.class.php");
include_once("../src/functions.inc.php");
include_once("../src/html.class.php");
include_once("../src/resFunction.inc.php");

if(!isset($_SESSION['admin']) && !isset($_SESSION['adminRole'])){
    alert("Invalid access!");
    redirectUrl("/");
    exit();
}

$level = $_SESSION['level'];
if($level == "ND1" || $level == "ND2"){
    $ccat = "ND";
}elseif($level == "HND1" || $level == "HND2"){
    $ccat = "HND";
}else{
    $ccat = "BSC";
}

if(isset($_GET['department'])){
    $lvl = htmlspecialchars($_GET['level']);
    $dept = htmlspecialchars($_GET['department']);
    $session = htmlspecialchars($_GET['session']);
    $semester = htmlspecialchars($_GET['semester']);
}

if($semester === "Second"){
print '<script>location.assign("listSecondSemesterResults.php");</script>';
exit();
}

?>
<?php
$html = new HtmlConfig();
$db = new DBRequest();

$html->startHtml();
$html->meta_description = "Welcome to Peace Institute of Management and Technology";
$html->title = "PIMT Portal::View Results";
$html->author = "PIMT";
$html->description = "Peace Institute Of Management And technology Mbarakom Abak (An Innovative Polytechnic) Was Established By The Proprietor, Mr. Efefiong Udosen In 2016 On The Basis Of Decree 33 Of 1978 and The Amended Decree 5 Of 1993. The Institution is A Private Innovative Polytechnic.";
$html->keywords = "undergradutae, Polytechnic, PIMT";

$html->addCss("../timaCss/tgt-style.css");
$html->addCss("../timaCss/w3css.css");
$html->addJs("../timaJs/timaJs.js");

$html->renderHtmlHead();
$html->closeHtmlConfig();
?>
<style>
    th{
        font-size: 12px; text-align: center;
    }
    td{
        font-size: 8px; text-align:center;font-weight:bold;
    }
</style>
<body>
    <div class="w3-container">
    <?php

    print '<span class="tgt-full-width"><h2 class="tgt-center">Result for '.$level.' | '.$semester.' Semester | Session: '.$session.'</h2></span>';

    print '<table border="1" class="stripped" style="width:100%; float:left">
      <tr>
        <th width="5" rowspan="2" scope="col">S/N</th>
        <th colspan="15" scope="col">Present Semester Performance </th>
        <th colspan="5" scope="col">Performance Summary</th>
      </tr>
      <tr>
        <th colspan="13" scope="col">Core Courses </th>
        <th colspan="2" scope="col">Electives</th>
        <th scope="col">TCR</th>
        <th scope="col">TCE</th>
        <th scope="col">TGP</th>
        <th scope="col">GPA</th>
        <th scope="col">Remarks</th>
      </tr>';

      $sql = "SELECT * FROM results WHERE department = '$dept' AND session = '$session' AND semester = '$semester' AND level = '$level' ORDER BY mat_num DESC";

    	$x = 0;

    	if($db->countRows($sql) > 0){

    		$res = $db->getData($sql);

    		foreach($res as $r){
    			$x++;

    			$cc1 = str_replace(" ","",$r['cc1']);
    			$g1 = $r['grade1'];
    			$cu1 = $r['cu1'];
    			$sc1 = $r['score1'];
    			if($cc1 != '0'){
    			    $cc1 = $cc1;
    			    $gp1 = gp($cu1,$g1);
    			}else{
    			    $cc1 = "";
    			    $g1 = "";
    			    $cu1 = "";
    			    $sc1 = "";
    			    $gp1 = "";
    			}

    			$g2 = $r['grade2'];
    			$cc2 = str_replace(" ","",$r['cc2']);
    			$cu2 = $r['cu2'];
    			$sc2 = $r['score2'];
    			if($cc2 != '0'){
    			    $cc2 = $cc2;
    			    $gp2 = gp($cu2,$g2);
    			}else{
    			    $cc2 = "";
    			    $g2 = "";
    			    $cu2 = "";
    			    $sc2 = "";
    			    $gp2 = "";
    			}

    			$cc3 = str_replace(" ","",$r['cc3']);
    			$g3 = $r['grade3'];
    			$cu3 = $r['cu3'];
    			$sc3 = $r['score3'];
    			if($cc3 != '0'){
    			    $cc3 = $cc3;
    			    $gp3 = gp($cu3,$g3);
    			}else{
    			    $cc3 = "";
    			    $g3 = "";
    			    $cu3 = "";
    			    $sc3 = "";
    			    $gp = "";
    			}
    			$cc4 = str_replace(" ","",$r['cc4']);
    			$g4 = $r['grade4'];
    			$cu4 = $r['cu4'];
    			$sc4 = $r['score4'];
    			if($cc4 != '0'){
    			    $cc4 = $cc4;
    			    $gp4 = gp($cu4,$g4);
    			}else{
    			    $cc4 = "";
    			    $g4 = "";
    			    $cu4 = "";
    			    $sc4 = "";
    			    $gp4 = "";
    			}
    			$cc5 = str_replace(" ","",$r['cc5']);
    			$g5 = $r['grade5'];
    			$cu5 = $r['cu5'];
    			$sc5 = $r['score5'];
    			if($cc5 != '0'){
    			    $cc5 = $cc5;
    			    $gp5 = gp($cu5,$g5);
    			}else{
    			    $cc5 = "";
    			    $g5 = "";
    			    $cu5 = "";
    			    $sc5 = "";
    			    $gp5 = "";
    			}
    			$cc6 = str_replace(" ","",$r['cc6']);
    			$g6 = $r['grade6'];
    			$cu6 = $r['cu6'];
    			$sc6 = $r['score6'];
    			if($cc6 != '0'){
    			    $cc6 = $cc6;
    			    $gp6 = gp($cu6,$g6);
    			}else{
    			    $cc6 = "";
    			    $g6 = "";
    			    $cu6 = "";
    			    $sc6 = "";
    			    $gp6 = "";
    			}
    			$cc7 = str_replace(" ","",$r['cc7']);
    			$g7 = $r['grade7'];
    			$cu7 = $r['cu7'];
    			$sc7 = $r['score7'];
    			if($cc7 != '0'){
    			    $cc7 = $cc7;
    			    $gp7 = gp($cu7,$g7);
    			}else{
    			    $cc7 = "";
    			    $g7 = "";
    			    $cu7 = "";
    			    $sc7 = "";
    			    $gp7 = "";
    			}
    			$cc8 = str_replace(" ","",$r['cc8']);
    			$g8 = $r['grade8'];
    			$cu8 = $r['cu8'];
    			$sc8 = $r['score8'];
    			if($cc8 != '0'){
    			    $cc8 = $cc8;
    			    $gp8 = gp($cu8,$g8);
    			}else{
    			    $cc8 = "";
    			    $g8 = "";
    			    $cu8 = "";
    			    $sc8 = "";
    			    $gp8 = "";
    			}
    			$cc9 = str_replace(" ","",$r['cc9']);
    			$g9 = $r['grade9'];
    			$cu9 = $r['cu9'];
    			$sc9 = $r['score9'];
    			if($cc9 != '0'){
    			    $cc9 = $cc9;
    			    $gp9 = gp($cu9,$g9);
    			}else{
    			    $cc9 = "";
    			    $g9 = "";
    			    $cu9 = "";
    			    $sc9 = "";
    			    $gp9 = "";
    			}
    			$cc10 = str_replace(" ","",$r['cc10']);
    			$g10 = $r['grade10'];
    			$cu10 = $r['cu10'];
    			$sc10 = $r['score10'];
    			if($cc10 != '0'){
    			    $cc10 = $cc10;
    			    $gp10 = gp($cu10,$g10);
    			}else{
    			    $cc10 = "";
    			    $g10 = "";
    			    $cu10 = "";
    			    $sc10 = "";
    			    $gp10 = "";
    			}
    			$cc11 = str_replace(" ","",$r['cc11']);
    			$g11 = $r['grade11'];
    			$cu11 = $r['cu11'];
    			$sc11 = $r['score11'];
    			if($cc11 != '0'){
    			    $cc11 = $cc11;
    			    $gp11 = gp($cu11,$g11);
    			}else{
    			    $cc11 = "";
    			    $g11 = "";
    			    $cu11 = "";
    			    $sc11 = "";
    			    $gp11 = "";
    			}

    			$remarks = unserialize($r['remarks']);

    			$mn = $r['mat_num'];
    			$fn = getFullName($db,$mn);
      print '<tr>
        <td width="5" rowspan="2" scope="col">'.$x.'</td>
        <td width="5" rowspan="2" align="center">'.$fn.'</td>
        <td width="5" rowspan="2" align="center">'.$mn.'</td>

        <td width="5">'.$cc1.'<br>'.$cu1.'</td>
        <td width="5">'.$cc2.'<br>'.$cu2.'</td>
        <td width="5">'.$cc3.'<br>'.$cu3.'</td>
        <td width="5">'.$cc4.'<br>'.$cu4.'</td>
        <td width="5">'.$cc5.'<br>'.$cu5.'</td>
        <td width="5">'.$cc6.'<br>'.$cu6.'</td>
        <td width="5">'.$cc7.'<br>'.$cu7.'</td>
        <td width="5">'.$cc8.'<br>'.$cu8.'</td>
        <td width="5">'.$cc9.'<br>'.$cu9.'</td>
        <td width="5">'.$cc10.'<br>'.$cu10.'</td>
        <td width="5">'.$cc11.'<br>'.$cu11.'</td>
        <!--elective course titles here-->
        <td width="5"></td>
        <td width="5"></td>
        <!--end of elective course titles here-->
        <td width="5" rowspan="2" style="font-size:12px">'.$r['tcu'].'</td>
        <td width="5" rowspan="2" style="font-size:12px">'.$r['tce'].'</td>
        <td width="5" rowspan="2" style="font-size:12px">'.$r['tgp'].'</td>
        <td width="5" rowspan="2" style="font-size:12px">'.$r['gpa'].'</td>
        <td width="5" rowspan="2" style="font-weight:bold">';
        ?>
        <?php
        $rc = count($remarks);
        foreach($remarks as $rmkid => $val){
            if($val === '0'){
                print "";
            }else{
                if($rmkid < $rc && $val != '0'){
                    print $val.", ";
                }else{
                    print $val;
                }
            }

        }
        ?>
        <?php
      print '</td></tr>
      <tr>
        <td width="5">'.$sc1.''.$g1.'<br>'.$gp1.'</td>
        <td width="5">'.$sc2.''.$g2.'<br>'.$gp2.'</td>
        <td width="5">'.$sc3.''.$g3.'<br>'.$gp3.'</td>
        <td width="5">'.$sc4.''.$g4.'<br>'.$gp4.'</td>
        <td width="5">'.$sc5.''.$g5.'<br>'.$gp5.'</td>
        <td width="5">'.$sc6.''.$g6.'<br>'.$gp6.'</td>
        <td width="5">'.$sc7.''.$g7.'<br>'.$gp7.'</td>
        <td width="5">'.$sc8.''.$g8.'<br>'.$gp8.'</td>
        <td width="5">'.$sc9.''.$g9.'<br>'.$gp9.'</td>
        <td width="5">'.$sc10.''.$g10.'<br>'.$gp10.'</td>
        <td width="5">'.$sc11.''.$g11.'<br>'.$gp11.'</td>
        <!--elective here-->
        <td width="5"></td>
        <td width="5"></td>
      </tr>';

    		}

    	}

      ?>
     </div>
</table>
</body>
</html>
