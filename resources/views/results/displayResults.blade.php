<?php
global $router;
 $semester = $router->input('semester');
   $session_id = $router->input('session');
   $level_id = $router->input('level');

   echo '<span class="full-width"><h2 class="center">Result for '.getLevelName($level_id).' Level, '.$semester.' Semester, Session: '.getSessionTitle($session_id).'</h2></span>';

   echo '<table width="100%" border="1" cellpadding="1" cellspacing="1" style="font-size: 70%;border-collapse:collapse">
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
           <td style="width: 6.6%">TCC</td>
           <td style="width: 6.6%">TCE</td>
           <td style="width: 6.6%">TGP</td>
           <td style="width: 6.6%">GPA</td>
         </tr>
       </table>

   </th>
   <th scope="col">Remarks</th>
 </tr>';

   $sql = "SELECT * FROM results WHERE session_id = '$session_id' AND semester = '$semester' AND level_id = '$level_id' ORDER BY id DESC";
   $x = 0;

   if($router->countRows($sql) > 0){

       $res = $router->select($sql);

       foreach($res as $r){
           $x++;
           $cc1 = $r['cc1'];
           $g1 = $r['grade1'];
     $gp = $r['gpa'];
     $remarks = unserialize($r['remarks']);
     if(empty($remarks)){
       $ov_rmk = "PASS";
     }else{
       $ov_rmk = implode(",", $remarks);
     }
     // $cgpa = getStdntCGPA($r['mat_num'], $level_id, $gp);

           echo '<tr>
   <th scope="col">'.$x.'</th>
   <th scope="col">'.getFullName($r['mat_num']).'</th>
   <th scope="col">'.$r['mat_num'].'</th>
   <th scope="col">

   <table border="1" style="width:100%;border-collapse:collapse" cellspacing="1" cellpadding="1">
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
       <td style="width: 6.6%">'.$r['tcu'].'</td>
       <td style="width: 6.6%">'.$r['tce'].'</td>
       <td style="width: 6.6%">'.$r['tgp'].'</td>
       <td style="width: 6.6%">'.$r['gpa'].'</td>
     </tr>
     <tr>
       <td style="width: 6.6%">'.$r['score1'].''.$r['grade1'].' '.getCtype($r['cc1']).'</td>
       <td style="width: 6.6%">'.$r['score2'].''.$r['grade2'].' '.getCtype($r['cc2']).'</td>
       <td style="width: 6.6%">'.$r['score3'].''.$r['grade3'].' '.getCtype($r['cc3']).'</td>
       <td style="width: 6.6%">'.$r['score4'].''.$r['grade4'].' '.getCtype($r['cc4']).'</td>
       <td style="width: 6.6%">'.$r['score5'].''.$r['grade5'].' '.getCtype($r['cc5']).'</td>
       <td style="width: 6.6%">'.$r['score6'].''.$r['grade6'].' '.getCtype($r['cc6']).'</td>
       <td style="width: 6.6%">'.$r['score7'].''.$r['grade7'].' '.getCtype($r['cc7']).'</td>
       <td style="width: 6.6%">'.$r['score8'].''.$r['grade8'].' '.getCtype($r['cc8']).'</td>
       <td style="width: 6.6%">'.$r['score9'].''.$r['grade9'].' '.getCtype($r['cc9']).'</td>
       <td style="width: 6.6%">'.$r['score10'].''.$r['grade10'].' '.getCtype($r['cc10']).'</td>
       <td style="width: 6.6%">'.$r['score11'].''.$r['grade11'].' '.getCtype($r['cc11']).'</td>
     </tr>
   </table></th>

   <th scope="col">'.$ov_rmk.'</th>
 </tr>';
       }

   }else{
       echo '<tr><td colspan="10">No data found...</td></tr>';
       //echo $db->connection_error($sql);
   }

   echo '</table>';
