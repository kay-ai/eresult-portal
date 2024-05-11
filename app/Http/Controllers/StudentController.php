<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Level;
use App\Models\Department;
use App\Models\AcademicSession;

class StudentController extends Controller
{
    public function index(){
        $levels = Level::all();
        return view('enrollStudents', compact('levels'));
    }

    public function enrollStudents(){
        //
    }

    public function view(){
        $levels = Level::all();
        $departments = Department::all();
        $sessions = AcademicSession::all();
        $students = Student::orderBy('mat_num', 'asc')->get();
        return view('studentList', compact('levels', 'departments', 'sessions', 'students'));
    }

    public function fetchStudents(Request $request)
    {

        $output = "";
        $semester = $request->input('semester');
        $session_id = $request->input('session');
        $level_id = $request->input('level');

        $students = Student::where('semester', $semester)->where('academic_session_id', $session_id)->where('level_id', $level_id)->get();

        if ($students) {
            foreach ($students as $key => $val) {
                $output .= '<tr>
                    <td>'.($key+1).'</td>
                    <td>'.$val->mat_num.'</td>
                    <td>'.$val->fname.'</td>
                    <td>'.$val->mname.'</td>
                    <td>'.$val->lname.'</td>
                    <td>'.$val->gender.'</td>
                    <td>'.$val->level->name.'</td>
                    <td>'.$val->academicSession->title.'</td>
                    <td></td>
                </tr>';
            }
        } else {
            $output .= '<tr>
                <td colspan="10" class="text-center">No records found...</td>
            </tr>';
        }

        return $output;

    }

    public function store(Request $request)
    {

        $file = $request->file('csv');

        $file_name = $file->getClientOriginalName();
        $file_extension = $file->getClientOriginalExtension();

        if ($file_extension == 'csv') {
            $row = 0;
            if (($handle = fopen($file, "r")) !== false) {
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    $row++;
                    if ($row == 1) {
                        // Skip the header row
                        continue;
                    }

                    $fn = ucfirst(trim($data[1]));
                    $mn = ucfirst(trim($data[2]));
                    $ln = ucfirst(trim($data[3]));
                    $gender = ucfirst(trim($data[4]));
                    $mat_num = ucfirst(trim($data[5]));
                    $level = trim($data[6]);
                    $semester = ucfirst(trim($data[7]));
                    $session = ucfirst(trim($data[8]));

                    $session_id = $this->getSessionId($session);
                    $level_id = $this->getLevelId($level);

                    $student = new Student();
                    $student->fname = $fn;
                    $student->lname = $ln;
                    $student->mname = $mn;
                    $student->gender = $gender;
                    $student->level_id = $level_id;
                    $student->semester = $semester;
                    $student->academic_session_id = $session_id;
                    $student->mat_num = $mat_num;
                    $student->status = 1;

                    $existing_student = Student::where('mat_num', $mat_num)->where('level_id', $level_id)->where('academic_session_id', $session_id)->count();
                    if($existing_student > 0)
                    {

                    }else{
                        try {
                            $student->save();
                            print "<p>Data uploaded successfully for: ".$mat_num."</p>";
                        } catch (\Exception $e) {
                            echo "Sorry, upload failed!";
                            print $e->getMessage();
                            break;
                        }
                    }

                }
                fclose($handle);
            }
        } else {
            echo "Please select a CSV file extension!!!";
        }
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

    public function destroy(Request $request)
    {

    }
}
