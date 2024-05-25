<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Result;
use App\Models\SecondSemesterResult;
use App\Models\Level;
use App\Models\Account;
use App\Models\Department;
use App\Models\AcademicSession;
use App\Models\Grade;
use App\Models\Carryover;
use App\Models\Carryover;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $levels = Level::all();
        $departments = Department::all();
        $sessions = AcademicSession::all();
        return view('results.index', compact('levels', 'departments', 'sessions'));
    }

    public function transcript()
    {
        $levels = Level::all();
        $departments = Department::all();
        $sessions = AcademicSession::all();
        return view('results.transcript', compact('levels', 'departments', 'sessions'));
    }

    public function uploadResults(Request $request)
    {
        $levels = Level::all();
        $departments = Department::all();
        $sessions = AcademicSession::all();
        return view('results.uploadResult', compact('levels', 'departments', 'sessions'));
    }

    public function resultStats()
    {
        return view('results.index');
    }

    public function courseStats()
    {
        $levels = Level::all();
        $departments = Department::all();
        $sessions = AcademicSession::all();
        return view('results.resultStats', compact('levels', 'departments', 'sessions'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('csv')) {
            $file = $request->file('csv');
            $fileExtension = $file->getClientOriginalExtension();

            if ($fileExtension == 'csv') {
                $filePath = $file->getRealPath();
                $csvData = array_map('str_getcsv', file($filePath));
                $details = '';

                foreach ($csvData as $key => $row) {
                    if ($key == 0) {
                        continue;
                    }

                    $mat_num = trim($row[1]);
                    $tce = [];
                    $tgp = [];
                    $tcu = [];
                    $remarks = [];
                    $cleared = [];

                    $rset = [];
                    $y = 1;
                    for ($i = 2; $i <= 23; $i += 2) {
                        $cc = strtoupper(trim($row[$i]));
                        $tot = trim($row[$i + 1]);

                        if (empty($cc)) {
                            $cc1 = null;
                            $cu1 = null;
                            $tot1 = null;
                            $g1 = null;
                            $r1 = null;
                            $gp1 = null;
                        } else {
                            $cu1 = $this->getCU($cc);
                            $tcu[] = $cu1;

                            $g1 = $this->gradeP($tot);
                            if ($g1 != 'F') {
                                $tce[] = $cu1;
                            }

                            $r1 = $this->rmkP($tot);
                            $gp1 = $this->gp($cu1, $g1);
                            $tgp[] = $gp1;

                            if ($g1 == 'F') {
                                $remarks[] = $cc;
                            }else{
                                $cleared[] = $cc;
                            }
                        }

                        $rset['cc'.$y] = $cc;
                        $rset['cu'.$y] = $cu1;
                        $rset['score'.$y] = $tot;
                        $rset['grade'.$y] = $g1;
                        $rset['rmk'.$y] = $r1;

                        $y++;
                    }

                    $dept = trim($row[26]);

                    $semester = trim($row[27]);
                    $level = trim($row[28]);
                    $session = trim($row[29]);

                    $academic_session_id = $this->getSessionId($session);

                    $level_id = $this->getLevelId($level);

                    $department_id = $this->getDepartmentId($dept);

                    $this->recordCO($remarks, $mat_num, $department_id, $semester, $level_id, $academic_session_id);

                    $this->recordCO($remarks, $mat_num, $department_id, $semester, $level_id, $session_id);

                    $resolved = $this->resolveCO($mat_num, $cleared, $semester, $level_id, $session);

                    if($resolved != null){
                        $remarks = array_merge($resolved, $remarks);
                    }

                    $remarks = serialize($remarks);
                    $tgpSum = array_sum($tgp);
                    $tcuSum = array_sum($tcu);
                    $tceSum = array_sum($tce);

                    if ($tcuSum > 30) {
                        $details .= '<p class="text-danger">Maximum credit units exceeded for '.$mat_num.'!</p>';
                        $details .= '<p class="text-danger">Maximum credit units exceeded for '.$mat_num.'!</p>';
                        continue;
                    }

                    $gpa = ($tgpSum / $tcuSum) ?: $tgpSum;
                    $gpa = round($gpa, 2);

                    if($semester == "First"){

                    if($semester == "First"){

                        $rset = array_merge($rset, [
                            'tce' => $tceSum,
                            'tcu' => $tcuSum,
                            'tgp' => $tgpSum,
                            'gpa' => $gpa,
                            'remarks' => $remarks,
                        ]);
                        $rset = array_merge($rset, [
                            'tce' => $tceSum,
                            'tcu' => $tcuSum,
                            'tgp' => $tgpSum,
                            'gpa' => $gpa,
                            'remarks' => $remarks,
                        ]);

                        $result = Result::updateOrCreate(
                            ['mat_num' => $mat_num, 'level_id' => $level_id, 'academic_session_id' => $academic_session_id, 'department_id' => $department_id, 'semester' => $semester],
                            $rset,
                        );
                        $result = Result::updateOrCreate(
                            ['mat_num' => $mat_num, 'level_id' => $level_id, 'academic_session_id' => $academic_session_id, 'semester' => $semester],
                            $rset,
                        );

                    }else{

                        $pgpa = $this->prevGpa($mat_num, $level_id);
                        if($pgpa != null){
                            $cgpa = round((($gpa + $pgpa)/2),2);
                        }else{
                            $cgpa = 0;
                        }


                        $pcgpa = $this->prevCgpa($mat_num, $level_id);

                        $rset = array_merge($rset, [
                            'tce' => $tceSum,
                            'tcu' => $tcuSum,
                            'tgp' => $tgpSum,
                            'gpa' => $gpa,
                            'pgpa' => $pgpa,
                            'cgpa' => $cgpa,
                            'pcgpa' => $pcgpa,
                            'remarks' => $remarks,
                        ]);

                        $result = SecondSemesterResult::updateOrCreate(
                            ['mat_num' => $mat_num, 'level_id' => $level_id, 'academic_session_id' => $academic_session_id, 'department_id' => $department_id, 'department_id' => $department_id, 'semester' => $semester],
                            $rset,
                        );
                    }

                    if ($result) {
                        $details .= '<p>'.$mat_num .' result computed successfully!</p>';
                    } else {
                        $details .= "<p>Failed to compute result for ".$mat_num."</p>";
                    }
                }

                echo $details;
                echo '<p><a href="javascript:history.back();"><button>Back</button></a></p>';
            }
        }
    }

    private function getDepartmentId($dept)
    {
        $department = Department::where('name', $dept)->first();
        if($department)
        {
            return $department->id;
        }
        return null;
    }

    private function getSessionId($session)
    {
        $session = AcademicSession::where('title', $session)->first();
        if($session)
        {
            return $session->id;
        }
        return null;
    }

    private function getLevelId($level)
    {
        $level = Level::where('name', $level)->first();
        if($level)
        {
            return $level->id;
        }
        return null;
    }

    private function getSession($session_id)
    {
        $session = AcademicSession::where('id', $session_id)->first();
        if($session)
        {
            return $session->title;
        }
        return null;
    }

    private function getLevel($level_id)
    {
        $level = Level::where('id', $level_id)->first();
        if($level)
        {
            return $level->name;
        }
        return null;
    }

    private function gradeP($tot)
    {
        $grades = Grade::all();
        if(count($grades) > 0){
            foreach($grades as $key => $val){
                if($tot >= $val->_from && $tot <= $val->_to){
                    return $val->_type;
                }
            }
        }else{
            if ($tot <= 39.9) {
                return "F";
            } elseif ($tot <= 44.9) {
                return "E";
            } elseif ($tot <= 49.9) {
                return "D";
            } elseif ($tot <= 59.9) {
                return "C";
            } elseif ($tot <= 69.9) {
                return "B";
            } else {
                return "A";
            }
        }
    }

    private function rmkP($tot)
    {
        $grade = Grade::where('_type', 'F')->first();
        if($grade){
            return ($tot <= $grade->_to) ? "Fail" : "Pass";
        }else{
            return ($tot <= 39.9) ? "Fail" : "Pass";
        }
    }

    private function gp($cu, $g)
    {
        return ($g == "F") ? ($cu * 0) : (($g == "D") ? ($cu * 1) : (($g == "C") ? ($cu * 2) : (($g == "B") ? ($cu * 3) : ($cu * 4))));
    }

    private function getCU($cc)
    {
        $course = Course::where('code', $cc)->first();
        if ($course) {
            return $course->unit;
        } else {
            return false;
        }
    }

    public function destroy(Request $request)
    {
        $year = $request->year;
        $semester = $request->semester;
        $level = $request->level;

        $results = Result::where('year', $year)->where('semester', $semester)->where('level', $level)->get();
        if($results)
        {
            $results->delete();
        }
    }

    public function show(Request $request)
    {
        $department_id = $request->department_id;
        $session_id = $request->session_id;
        $semester = $request->semester;
        $level_id = $request->level_id;
        $department_id = $request->department_id;

        $level = $this->getLevel($level_id);
        $session = $this->getSession($session_id);

        $account = Account::first();

        $courses = Course::where('semester', $semester)->get();

        $courses = Course::where('semester', $semester)->get();

        $department = Department::find($department_id);
        if($semester == 'Second'){
            $results = SecondSemesterResult::where('academic_session_id', $session_id)->where('semester', $semester)->where('level_id', $level_id)->where('department_id', $department_id)->get();
            return view('results.displaySecondSemesterResults', compact('session', 'semester', 'level', 'results', 'account', 'department', 'courses'));
            return view('results.displaySecondSemesterResults', compact('session', 'semester', 'level', 'results', 'account', 'department', 'courses'));
        }else{
            $results = Result::where('academic_session_id', $session_id)->where('semester', $semester)->where('level_id', $level_id)->where('department_id', $department_id)->get();
            return view('results.displayResults', compact('session', 'semester', 'level', 'results', 'account', 'department', 'courses'));
            return view('results.displayResults', compact('session', 'semester', 'level', 'results', 'account', 'department', 'courses'));
        }

    }

    private function getStdntCGPA($mn, $semester, $level_id, $gp){
        if($semester == 'Second'){
            $res = SecondSemesterResult::where('mat_num', $mn)->where('level_id', $level_id)->first();
            if($res){
                $cgpa = $res->cgpa;
                $cgpa = ($cgpa+$gp)/2;
                return round($cgpa,2);
            }
        }else{
            $res = Result::where('mat_num', $mn)->where('level_id', $level_id)->first();
            if($res){
                $gpa = $res->gpa;
                $cgpa = ($gpa+$gp)/2;
                return round($cgpa,2);
            }

        }

    }

    private function prevGpa($mn, $level_id){

        $res = Result::where('mat_num', $mn)->where('level_id', $level_id)->first();
        if($res){
            return $res->gpa;
        }
        return null;
    }

    private function prevCgpa($mn, $level_id){

        $res = SecondSemesterResult::where('mat_num', $mn)->where('level_id', $level_id)->first();
        if($res){
            return $res->cgpa;
        }
        return null;

    }

    private function resolveCO($mn, $cleared, $semester, $level_id, $session)
    {
        $year = substr($session,0,4);
        $_session = (($year-1).'/'.$year);
        $_session_id = $this->getSessionId($_session);
        $cr = [];
        if($semester == 'First'){
            $f_rmks = Result::where('mat_num', $mn)->where('semester', $semester)->where('academic_session_id', $_session_id)->first();
            if($f_rmks){
                $x_rmks = unserialize($f_rmks->remarks);
                if(empty($x_rmks))
                {
                    // $cr = $remarks;
                }else{
                    foreach($x_rmks as $rmk)
                    {
                        if(!in_array($rmk, $cleared)){
                            $cr[] = $rmk;
                        }
                    }

                    return $cr;
                }
            }
        }else{
            $f_rmks = SecondSemesterResult::where('mat_num', $mn)->where('semester', $semester)->where('academic_session_id', $_session_id)->first();
            if($f_rmks){
                $x_rmks = unserialize($f_rmks->remarks);
                if(empty($x_rmks))
                {
                    // $cr = $remarks;
                }else{
                    foreach($x_rmks as $rmk)
                    {
                        if(!in_array($rmk, $cleared)){
                            $cr[] = $rmk;
                        }
                    }

                    return $cr;
                }
            }
            return [];
        }
    }

    private function recordCO($array, $mat_num, $department_id, $semester, $level_id, $session_id)
    {
        if(!empty($array)){
            $carryover = new Carryover();
            foreach($array as $key => $val){
                $carryover->level_id = $level_id;
                $carryover->cc = $val;
                $carryover->academic_session_id = $session_id;
                $carryover->semester = $semester;
                $carryover->mat_num = $mat_num;
                $carryover->department_id = $department_id;

                $carryover->save();
            }
        }
    }

    private function recordCO($array, $mat_num, $department_id, $semester, $level_id, $session_id)
    {
        if(!empty($array)){
            $carryover = new Carryover();
            foreach($array as $key => $val){
                $carryover->level_id = $level_id;
                $carryover->cc = $val;
                $carryover->academic_session_id = $session_id;
                $carryover->semester = $semester;
                $carryover->mat_num = $mat_num;
                $carryover->department_id = $department_id;

                $carryover->save();
            }
        }
    }
}
