<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Level;
use App\Models\Department;
use App\Models\AcademicSession;
use App\Models\Result;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(){
        $levels = Level::all();
        $departments = Department::all();
        $sessions = AcademicSession::all();
        return view('students.enrollStudents', compact('levels', 'departments', 'sessions',));
    }

    public function enrollStudents(){
        //
    }

    public function view(){
        $levels = Level::all();
        $departments = Department::all();
        $sessions = AcademicSession::all();
        $students = Student::orderBy('mat_num', 'asc')->get();
        return view('students.studentList', compact('levels', 'departments', 'sessions', 'students'));
    }

    public function fetchStudents(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'semester' => ['string', 'required'],
            'session_id' => ['integer', 'required'],
            'level_id' => ['integer', 'required'],
            'department_id' => ['integer', 'required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors())->withInput();
        }

        $semester = $request->input('semester');
        $session_id = $request->input('session_id');
        $level_id = $request->input('level_id');
        $department_id = $request->input('department_id');

        $levels = Level::all();
        $departments = Department::all();
        $sessions = AcademicSession::all();

        $students = Student::where(['semester'=> $semester , 'academic_session_id'=> $session_id, 'level_id'=> $level_id, 'department_id'=>$department_id])->orderBy('mat_num', 'asc')->get();

        return view('students.studentList', compact('levels', 'departments', 'sessions', 'students'));
    }

    public function fetchStudentsDashboard(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'semester' => ['string', 'required'],
            'session_id' => ['integer', 'required'],
            'level_id' => ['integer', 'required'],
            'department_id' => ['integer', 'required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors())->withInput();
        }

        $semester = $request->input('semester');
        $session_id = $request->input('session_id');
        $level_id = $request->input('level_id');
        $department_id = $request->input('department_id');

        $levels = Level::all();
        $departments = Department::all();
        $sessions = AcademicSession::all();

        $users = User::latest()->get();
        $studentsC = Student::latest()->get();
        $results = Result::latest()->get();
        $studentCount = count($studentsC);
        $resultCount = count($results);

        $students = Student::where(['semester'=> $semester , 'academic_session_id'=> $session_id, 'level_id'=> $level_id, 'department_id'=>$department_id])->orderBy('mat_num', 'asc')->get();

        return view('dashboard', compact('levels', 'departments', 'sessions', 'students', 'users', 'studentCount','resultCount'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'semester' => ['string', 'required'],
            'session_id' => ['integer', 'required'],
            'level_id' => ['integer', 'required'],
            'department_id' => ['integer', 'required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors())->withInput();
        }

        $semester = $request->input('semester');
        $session_id = $request->input('session_id');
        $level_id = $request->input('level_id');
        $department_id = $request->input('department_id');

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
                    $email = trim($data[6]);
                    $phone_number = ucfirst(trim($data[7]));
                    $jamb_no = ucfirst(trim($data[8]));
                    $prog_type = ucfirst(trim($data[9]));

                    $existing_student = Student::where(['mat_num'=> $mat_num, 'level_id'=> $level_id, 'academic_session_id'=> $session_id, 'department_id'=>$department_id])->count();

                    if($existing_student){
                        $session = AcademicSession::where('id',$session_id)->first();
                        print "<p>Student with Mat Num: ".$mat_num." already exists in ".$session->title." academic session</p>";
                        continue;
                    }

                    $student = new Student();
                    $student->fname = $fn;
                    $student->lname = $ln;
                    $student->mname = $mn;
                    $student->gender = $gender;
                    $student->email = $email;
                    $student->phone_number = $phone_number;
                    $student->jamb_no = $jamb_no;
                    $student->prog_type = $prog_type;
                    $student->level_id = $level_id;
                    $student->semester = $semester;
                    $student->academic_session_id = $session_id;
                    $student->department_id = $department_id;
                    $student->mat_num = $mat_num;
                    $student->status = 1;

                    try {
                        $student->save();
                        print "<p>Data uploaded successfully for: ".$mat_num."</p>";
                    } catch (\Exception $e) {
                        echo "Sorry, upload failed!";
                        print $e->getMessage();
                        break;
                    }

                }
                fclose($handle);
            }
            echo '<p><a href="javascript:history.back();"><button>Back</button></a></p>';
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
