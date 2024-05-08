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
        return view('studentList', compact('levels', 'departments', 'sessions'));
    }

    public function fetchStudents(Request $request)
    {

        $output = "";
        $semester = $request->input('semester');
        $session_id = $request->input('session');
        $level_id = $request->input('level');

        $students = Student::select('students.fname', 'students.lname', 'students.mname', 'students.mat_num', 'students.created_at', 'levels.name as level_name', 'academic_sessions.title')
            ->join('academic_sessions', 'students.session_id', '=', 'academic_sessions.id')
            ->join('levels', 'students.level_id', '=', 'levels.id')
            ->where('students.session_id', $session_id)
            ->where('students.semester', $semester)
            ->where('students.level_id', $level_id)
            ->get();

        if ($students->count() > 0) {
            foreach ($students as $key => $val) {
                $output .= '<tr>
                    <td>'.($key+1).'</td>
                    <td>'.$val->mat_num.'</td>
                    <td>'.$val->fname.'</td>
                    <td>'.$val->mname.'</td>
                    <td>'.$val->lname.'</td>
                    <td>'.$val->level_name.'</td>
                    <td>'.$val->title.'</td>
                    <td></td>
                </tr>';
            }
        } else {
            $output .= '<tr>
                <td colspan="9" class="text-center">No records found...</td>
            </tr>';
        }

        return $output;

    }

    public function store(Request $request)
    {

        $file = $request->file('csv');
        $today = now();

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
                    $mat_num = ucfirst(trim($data[4]));
                    $level = trim($data[5]);
                    $semester = ucfirst(trim($data[6]));
                    $session = ucfirst(trim($data[7]));

                    $session_id = $this->getSessionId($session);
                    $level_id = $this->getLevelId($level);

                    $student = new Student();
                    $student->fname = $fn;
                    $student->lname = $ln;
                    $student->mname = $mn;
                    $student->level_id = $level_id;
                    $student->semester = $semester;
                    $student->session_id = $session_id;
                    $student->mat_num = $mat_num;

                    try {
                        $student->save();
                        print "<p>Data was uploaded successfully for: ".$mat_num."</p>";
                    } catch (\Exception $e) {
                        echo "Sorry, upload failed!";
                        print $e->getMessage();
                        break;
                    }
                }
                fclose($handle);
            }
        } else {
            echo "Please select a CSV file extension!!!";
        }
    }

    public function destroy(Request $request)
    {

    }
}
