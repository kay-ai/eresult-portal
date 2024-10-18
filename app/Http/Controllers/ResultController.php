<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Result;
use App\Models\Gpa;
use App\Models\SecondSemesterResult;
use App\Models\Level;
use App\Models\Account;
use App\Models\Department;
use App\Models\AcademicSession;
use App\Models\Grade;
use App\Models\Carryover;
use App\Models\CarryOverResult;
use App\Models\ExamOfficer;
use App\Models\SecondCarryOverResult;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

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

    public function uploadCarryoverResults(Request $request)
    {
        $levels = Level::all();
        $departments = Department::all();
        $sessions = AcademicSession::all();
        return view('results.uploadCarryoverResult', compact('levels', 'departments', 'sessions'));
    }

    public function resultStats()
    {
        $levels = Level::all();
        $departments = Department::all();
        $sessions = AcademicSession::all();
        return view('results.resultStats', compact('levels', 'departments', 'sessions'));
    }

    public function resultStatsView(Request $request)
    {
        $semester = $request->semester;
        $level_id = $request->level_id;
        $department_id = $request->department_id;
        $session_id = $request->session_id;

        if($semester == 'First'){
            $results = Result::where([
                'level_id' => $level_id,
                'department_id' => $department_id,
                'academic_session_id' => $session_id
            ])->orderBy('mat_num', 'asc')->get();
        }else{
            $results = SecondSemesterResult::where([
                'level_id' => $level_id,
                'department_id' => $department_id,
                'academic_session_id' => $session_id
            ])->orderBy('mat_num', 'asc')->get();
        }

        $department = Department::where('id', $department_id)->first();
        $session = AcademicSession::where('id', $session_id)->first();
        $level = Level::where('id', $level_id)->first();

        $resultStat = [];
        if ($results) {
            for ($x = 1; $x <= 12; $x++) {
                $code = 'cc' . $x;
                $score = 'score' . $x;
                foreach ($results as $result) {
                    if (!$result->mat_num) continue;

                    if (!isset($resultStat[$result->mat_num])) {
                        $resultStat[$result->mat_num] = [
                            'mat_num' => '',
                            'full_name' => '',
                            'level' => $level->name,
                            'department' => $department->name,
                            'no_passed' => 0,
                            'no_failed' => 0,
                            'no_absent' => 0,
                        ];
                    }

                    $resultStat[$result->mat_num]['mat_num'] = $result->mat_num;
                    $resultStat[$result->mat_num]['full_name'] = $this->getFullName($result->mat_num);

                    if($result->$code){
                        if (empty($result->$score)) {
                            $resultStat[$result->mat_num]['no_absent'] += 1;
                        } elseif ($result->$score <= 39.9) {
                            $resultStat[$result->mat_num]['no_failed'] += 1;
                        } else {
                            $resultStat[$result->mat_num]['no_passed'] += 1;
                        }
                    }
                }
            }
        }


        return view('results.resultStatsShow', compact('resultStat', 'semester', 'department', 'level', 'session'));
    }

    public function courseStatsView(Request $request)
    {
        $semester = $request->semester;
        $level_id = $request->level_id;
        $department_id = $request->department_id;
        $session_id = $request->session_id;

        if($semester == 'First'){
            $results = Result::where([
                'level_id' => $level_id,
                'department_id' => $department_id,
                'academic_session_id' => $session_id
            ])->orderBy('mat_num', 'asc')->get();
        }else{
            $results = SecondSemesterResult::where([
                'level_id' => $level_id,
                'department_id' => $department_id,
                'academic_session_id' => $session_id
            ])->orderBy('mat_num', 'asc')->get();
        }

        $courseStat = [];
        if ($results) {
            for ($x = 1; $x <= 12; $x++) {
                $code = 'cc' . $x;
                $score = 'score' . $x;
                foreach ($results as $result) {
                    if (!$result->$code) continue;

                    if (!isset($courseStat[$result->$code])) {
                        $courseStat[$result->$code] = [
                            'code' => $result->$code,
                            'title' => $this->getCourseTitle($result->$code),
                            'students_no' => 0,
                            'no_passed' => 0,
                            'no_failed' => 0,
                            'no_absent' => 0,
                            'max' => 0,
                            'min' => PHP_INT_MAX,
                        ];
                    }

                    $courseStat[$result->$code]['students_no'] += 1;

                    if (empty($result->$score)) {
                        $courseStat[$result->$code]['no_absent'] += 1;
                    } elseif ($result->$score <= 39.9) {
                        $courseStat[$result->$code]['no_failed'] += 1;
                    } else {
                        $courseStat[$result->$code]['no_passed'] += 1;
                    }

                    if ($result->$score > $courseStat[$result->$code]['max']) $courseStat[$result->$code]['max'] = $result->$score;
                    if ($result->$score < $courseStat[$result->$code]['min']) $courseStat[$result->$code]['min'] = $result->$score;
                }
            }
        }
        $department = Department::where('id', $department_id)->first();
        $session = AcademicSession::where('id', $session_id)->first();
        $level = Level::where('id', $level_id)->first();

        return view('results.courseStatsShow', compact('courseStat', 'semester', 'department', 'level', 'session'));
    }

    public function courseStats()
    {
        $levels = Level::all();
        $departments = Department::all();
        $sessions = AcademicSession::all();
        return view('results.courseStats', compact('levels', 'departments', 'sessions'));
    }

    public function downloadTemplate(Request $request)
    {
        $semester = $request->semester;
        $level_id = $request->level_id;
        $department_id = $request->department_id;
        $session_id = $request->session_id;

        $courses = Course::where([
            'semester' => $semester,
            'level_id' => $level_id,
            'department_id' => $department_id
        ])->orderBy('id', 'desc')->get();

        $students = Student::where([
            'level_id' => $level_id,
            'department_id' => $department_id,
            'academic_session_id' => $session_id
        ])->orderBy('mat_num', 'asc')->get();

        // dd($students);

        $department = Department::where('id', $department_id)->first();
        $session = AcademicSession::where('id', $session_id)->first();
        $level = Level::where('id', $level_id)->first();

        $csvFileName = "result_template.csv";
        $filePath = storage_path('app/public/templates' . $csvFileName);

        $file = fopen($filePath, 'w');


        $header = ['sn','matric_num','cc1','score1','cc2','score2','cc3','score3','cc4','score4','cc5','score5','cc6','score6','cc7','score7', 'cc8','score8','cc9','score9','cc10','score10','cc11','score11','cc12','score12','dept','semester','level','academic_session'];
        fputcsv($file, $header);

        $row = array_fill(0, count($header), '');

        foreach($students as $key=> $student){
            $row[0] = $key+1;
            $row[1] = $student->mat_num;
            $row[26] = $department->name;
            $row[27] = $semester;
            $row[28] = $level->name;
            $row[29] = $session->title;

            foreach ($courses as $index => $course) {
                if ($index < 12) {
                    $row[2 + $index * 2] = $course->code;
                }
            }

            fputcsv($file, $row);
        }


        // Close the files
        fclose($file);

        // Return the file as a download response
        return response()->download($filePath, $csvFileName)->deleteFileAfterSend(true);
    }

    public function store(Request $request)
    {
        $form_semester = $request->semester;
        $form_level_id = $request->level_id;
        $form_department_id = $request->department_id;
        $form_session_id = $request->session_id;

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

                    $dept = trim($row[26]);
                    $semester = trim($row[27]);
                    $level = trim($row[28]);
                    $session = trim($row[29]);

                    $academic_session_id = $this->getSessionId($session);
                    $level_id = $this->getLevelId($level);
                    $department_id = $this->getDepartmentId($dept);

                    if($form_semester != $semester){
                        $details .= "<p style='color: red;'>Failed to compute result for ".$mat_num." Selected Semester does not match</p>";
                        continue;
                    }else if($form_level_id != $level_id ){
                        $details .= "<p style='color: red;'>Failed to compute result for ".$mat_num." Selected Level does not match</p>";
                        continue;
                    }else if($form_department_id != $department_id){
                        $details .= "<p style='color: red;'>Failed to compute result for ".$mat_num." Selected Department does not match</p>";
                        continue;
                    }else if($form_session_id != $academic_session_id){
                        $details .= "<p style='color: red;'>Failed to compute result for ".$mat_num." Selected Session does not match</p>";
                        continue;
                    }

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

                    $this->recordCO($remarks, $mat_num, $department_id, $semester, $level_id, $academic_session_id);

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
                        continue;
                    }

                    $gpa = ($tgpSum / $tcuSum) ?: $tgpSum;
                    $gpa = round($gpa, 2);

                    if($semester == "First"){

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

                        $store_gpa = Gpa::updateOrCreate(
                            [
                                'mat_num' => $mat_num,
                                'level_id' => $level_id,
                                'academic_session' => $session,
                                'department_id' => $department_id,
                                'semester' => $semester
                            ],
                            [
                                'gpa' => $gpa,
                                'tcu' => $tcuSum
                            ]
                        );

                    }else{

                        $pgpa = $this->prevGpa($mat_num, $level_id, $session, $department_id);
                        if(count($pgpa) != 0){
                            $_tgp_1 =  $pgpa['first'] * $pgpa['tcu'];
                            $_tgp_2 = $gpa * $tcuSum;
                            // dd($tcuSum);
                            $sum_of_gps = $_tgp_1 + $_tgp_2;
                            $sum_of_credit_points = $pgpa['tcu'] + $tcuSum;

                            $cgpa = ($sum_of_gps/$sum_of_credit_points);
                            $cgpa = round($cgpa, 2);
                        }else{
                            $cgpa = 0;
                        }

                        $pcgpa = null;//$this->prevCgpa($mat_num, $level_id, $session, $department_id);

                        $rset = array_merge($rset, [
                            'tce' => $tceSum,
                            'tcu' => $tcuSum,
                            'tgp' => $tgpSum,
                            'gpa' => $gpa,
                            'pgpa' => $pgpa['first'],
                            'cgpa' => $cgpa,
                            'pcgpa' => $pcgpa,
                            'remarks' => $remarks,
                        ]);

                        $result = SecondSemesterResult::updateOrCreate(
                            ['mat_num' => $mat_num, 'level_id' => $level_id, 'academic_session_id' => $academic_session_id, 'department_id' => $department_id, 'department_id' => $department_id, 'semester' => $semester],
                            $rset,
                        );

                        $store_gpa = Gpa::updateOrCreate(
                            [
                                'mat_num' => $mat_num,
                                'level_id' => $level_id,
                                'academic_session' => $session,
                                'department_id' => $department_id,
                                'semester' => $semester
                            ],
                            [
                                'gpa' => $gpa,
                                'tcu' => $tcuSum
                            ]
                        );

                    }

                    if ($result) {
                        $details .= '<p style="color: green;">'.$mat_num .' result computed successfully!</p>';
                    } else {
                        $details .= "<p style='color: red;'>Failed to compute result for ".$mat_num."</p>";
                    }
                }

                echo $details;
                echo '<p><a href="javascript:history.back();"><button>Back</button></a></p>';
            }
        }
    }

    public function storeCarryOverResults(Request $request)
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
                    //get existing results
                    if($request->semester == "First"){
                        $ex_results = Result::where('mat_num', $mat_num)->where('semester', $request->semester)->where('department_id', $request->department_id)->where('academic_session_id', $request->session_id)->where('level_id', $request->level_id)->first();
                    }else{
                        $ex_results = SecondSemesterResult::where('mat_num', $mat_num)->where('semester', $request->semester)->where('department_id', $request->department_id)->where('academic_session_id', $request->session_id)->where('level_id', $request->level_id)->first();
                    }

                    for ($i = 2; $i <= 23; $i += 2) {
                        $cc = strtoupper(trim($row[$i]));
                        $tot = trim($row[$i + 1]);
                        if (empty($tot)) {
                            $cc = $ex_results["cc".$y];
                            $cu1 = $ex_results["cu".$y];
                            $tot = $ex_results["score".$y];
                            $g1 = $ex_results["grade".$y];
                            $r1 = $ex_results["rmk".$y];

                            $gp1 = $this->gp($cu1, $g1);
                            // $gp1 = $ex_results["gp".$y];

                            $tcu[] = $cu1;

                            if ($g1 != 'F') {
                                $tce[] = $cu1;
                            }

                            $tgp[] = $gp1;

                            if ($g1 == 'F') {
                                $remarks[] = $cc;
                            }else{
                                $cleared[] = $cc;
                            }

                            $rset['cc'.$y] = $cc;
                            $rset['cu'.$y] = $cu1;
                            $rset['score'.$y] = $tot;
                            $rset['grade'.$y] = $g1;
                            $rset['rmk'.$y] = $r1;

                        } else {
                            $cu1 = $this->getCU($cc);
                            $tcu[] = $cu1;

                            $tot = trim($row[$i + 1]);

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

                            $rset['cc'.$y] = $cc;
                            $rset['cu'.$y] = $cu1;
                            $rset['score'.$y] = $tot;
                            $rset['grade'.$y] = $g1;
                            $rset['rmk'.$y] = $r1;
                        }

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
                        continue;
                    }

                    $gpa = ($tgpSum / $tcuSum) ?: $tgpSum;
                    $gpa = round($gpa, 2);

                    if($semester == "First"){

                        $rset = array_merge($rset, [
                            'tce' => $tceSum,
                            'tcu' => $tcuSum,
                            'tgp' => $tgpSum,
                            'gpa' => $gpa,
                            'remarks' => $remarks,
                        ]);

                        $result = CarryOverResult::updateOrCreate(
                            ['mat_num' => $mat_num, 'level_id' => $level_id, 'academic_session_id' => $academic_session_id, 'department_id' => $department_id, 'semester' => $semester],
                            $rset,
                        );

                        $result = Result::updateOrCreate(
                            ['mat_num' => $mat_num, 'level_id' => $level_id, 'academic_session_id' => $academic_session_id, 'department_id' => $department_id, 'semester' => $semester],
                            $rset,
                        );

                        $store_gpa = Gpa::updateOrCreate(
                            [
                                'mat_num' => $mat_num,
                                'level_id' => $level_id,
                                'academic_session' => $session,
                                'department_id' => $department_id,
                                'semester' => $semester
                            ],
                            [
                                'gpa' => $gpa,
                                'tgp' => $tgpSum
                            ]
                        );

                    }else{

                        $pgpa = $this->prevGpa($mat_num, $level_id, $session, $department_id);
                        if(count($pgpa) != 0){
                            $_tgp_1 =  $pgpa['first'] * $pgpa['tcu'];
                            $_tgp_2 = $gpa * $tcuSum;
                            // dd($tcuSum);
                            $sum_of_gps = $_tgp_1 + $_tgp_2;
                            $sum_of_credit_points = $pgpa['tcu'] + $tcuSum;

                            $cgpa = ($sum_of_gps/$sum_of_credit_points);
                            $cgpa = round($cgpa, 2);
                        }else{
                            $cgpa = 0;
                        }

                        $pcgpa = null;//$this->prevCgpa($mat_num, $level_id);

                        $rset = array_merge($rset, [
                            'tce' => $tceSum,
                            'tcu' => $tcuSum,
                            'tgp' => $tgpSum,
                            'gpa' => $gpa,
                            'pgpa' => $pgpa['first'],
                            'cgpa' => $cgpa,
                            'pcgpa' => $pcgpa,
                            'remarks' => $remarks,
                        ]);

                        $result = SecondCarryOverResult::updateOrCreate(
                            ['mat_num' => $mat_num, 'level_id' => $level_id, 'academic_session_id' => $academic_session_id, 'department_id' => $department_id, 'department_id' => $department_id, 'semester' => $semester],
                            $rset,
                        );

                        $result = SecondSemesterResult::updateOrCreate(
                            ['mat_num' => $mat_num, 'level_id' => $level_id, 'academic_session_id' => $academic_session_id, 'department_id' => $department_id, 'department_id' => $department_id, 'semester' => $semester],
                            $rset,
                        );

                        $store_gpa = Gpa::updateOrCreate(
                            [
                                'mat_num' => $mat_num,
                                'level_id' => $level_id,
                                'academic_session' => $session,
                                'department_id' => $department_id,
                                'semester' => $semester
                            ],
                            [
                                'gpa' => $gpa,
                                'tgp' => $tgpSum
                            ]
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
        if($g){
            $grade = Grade::where('_type', $g)->first();
            $weight = $grade->weight;

            return $cu * $weight;
        }

        return null;
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

    private function getCourseTitle($code)
    {
        $course = Course::where('code', $code)->first();
        if ($course) {
            return $course->title;
        } else {
            return false;
        }
    }

    private function getFullName($mat_num)
    {
        $student = Student::where('mat_num', $mat_num)->first();
        if ($student) {
            return $student->fname . ' ' . $student->lname;
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

        $level = $this->getLevel($level_id);
        $session = $this->getSession($session_id);

        $account = Account::first();

        $courses = Course::where([
            'semester' => $semester,
            'level_id' => $level_id,
            'department_id' => $department_id
        ])->orderBy('id', 'desc')->get();

        $department = Department::find($department_id);
        $exam_officer = ExamOfficer::where('department_id', $department_id)->first();

        if($semester == 'Second'){
            $results = SecondSemesterResult::where([
                'academic_session_id' => $session_id,
                'semester'=> $semester,
                'level_id'=> $level_id,
                'department_id'=> $department_id
            ])->get();
        }else{
            $results = Result::where([
                'academic_session_id' => $session_id,
                'semester'=> $semester,
                'level_id'=> $level_id,
                'department_id'=> $department_id
            ])->get();
        }

        return view('results.displayResults', compact('session', 'semester', 'level', 'results', 'account', 'department', 'exam_officer', 'courses'));

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

    private function prevGpa($mat_num, $level_id, $session, $department_id){
        $pgpa = Gpa::where('mat_num', $mat_num)
        ->where('level_id', $level_id)
        ->where('academic_session', $session)
        ->where('semester', 'First')
        ->where('department_id', $department_id)
        ->first();
        // $res = Result::where('mat_num', $mn)->where('level_id', $level_id)->first();

        if($pgpa){
            $data['first'] = $pgpa->gpa;
            $data['tcu'] = $pgpa->tcu;
            return $data;
        }
        return [];
    }

    //not applicable
    private function prevCgpa($mat_num, $level_id, $session, $department_id){
        $res = Gpa::where('mat_num', $mat_num)
        ->where('session', '<', $session)
        ->where('department_id', $department_id)
        ->get();
        // $res = SecondSemesterResult::where('mat_num', $mn)->where('level_id', $level_id)->first();
        $gpas = [];
        if($res){
            foreach($res as $r)
            {
                $gpas[] = $r->gpa;
            }
            $cgpa = round((array_sum($gpas) / count($gpas)), 2);
            return $cgpa;
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

                    //get carryovers from carryover table
                    $carryOvers = Carryover::where('level_id', $level_id)->where('academic_session_id', $_session_id)->where('semester', $semester)->where('mat_num', $mn)->get();
                    $ex_co = [];
                    if($carryOvers){
                        foreach($carryOvers as $key => $val){
                            $ex_co[] = $val->cc;
                        }
                    }

                    foreach($x_rmks as $co)
                    {
                        if(!in_array($co, $cleared)){
                            $cr[] = $co;
                        }else{
                            if(in_array($co, $ex_co)){
                                for($x = 0; $x < count($ex_co); $x++){
                                    if($ex_co[$x] == $co){
                                        $this_carryover = Carryover::where('level_id', $level_id)->where('academic_session_id', $_session_id)->where('semester', $semester)->where('mat_num', $mn)->where('cc', $co)->first();
                                        $this_carryover->status = 'pass';
                                        $this_carryover->save();
                                    }
                                }
                            }
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
            $ex_carryover = Carryover::where('level_id', $level_id)->where('academic_session_id', $session_id)->where('semester', $semester)->where('mat_num', $mat_num)->where('department_id', $department_id)->get();
            $ex_co = [];
            if($ex_carryover){
                foreach($ex_carryover as $key => $val){
                    $ex_co[] = $val->cc;
                }
            }

            // dd($array);
            foreach($array as $key => $val){
                // dd(!in_array($val, $ex_co));
                if(!in_array($val, $ex_co)){
                    $carryover = new Carryover();
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
}
