<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Result;
use App\Models\Level;
use App\Models\Department;
use App\Models\AcademicSession;
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

                            if ($tot < 39.9) {
                                $remarks[] = $cc;
                            }
                        }
                    }

                    $remarks = serialize($remarks);
                    $tgpSum = array_sum($tgp);
                    $tcuSum = array_sum($tcu);
                    $tceSum = array_sum($tce);

                    if ($tcuSum > 30) {
                        $details .= '<p class="w3-text-white">Maximum credit units exceeded for '.$mat_num.'!</p>';
                        continue;
                    }

                    $gpa = ($tgpSum / $tcuSum) ?: $tgpSum;
                    $gpa = round($gpa, 2);

                    $result = Result::updateOrCreate(
                        ['mat_num' => $mat_num, 'level_id' => $request->input('level'), 'session_id' => $request->input('session'), 'semester' => $request->input('semester')],
                        [
                            'tce' => $tceSum,
                            'tcu' => $tcuSum,
                            'tgp' => $tgpSum,
                            'gpa' => $gpa,
                            'remarks' => $remarks,
                        ]
                    );

                    if ($result) {
                        $details .= $mat_num ." result computed successfully!\n";
                    } else {
                        $details .= "Failed to compute result for ".$mat_num."\n";
                    }
                }

                echo $details;
                echo '<p><a href="'.url()->previous().'"><button>Back</button></a></p>';
            }
        }
    }

    private function gradeP($tot)
    {
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

    private function rmkP($tot)
    {
        return ($tot <= 39.9) ? "Fail" : "Pass";
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
            echo '<p>'.$cc.' course not found!</p>';
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
        $year = $request->year;
        $semester = $request->semester;
        $level = $request->level;
        $results = Result::where('year', $year)->where('semester', $semester)->where('level', $level)->get();
        return view('displayResults', compact('year', 'semester', 'level', 'results'));
    }
}
