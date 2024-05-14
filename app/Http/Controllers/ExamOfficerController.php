<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamOfficer;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

class ExamOfficerController extends Controller
{
    public function index(){
        $examOfficers = ExamOfficer::all();
        $users = User::all();
        $departments = Department::all();
        return view('superAdmin.examOfficers', compact('examOfficers', 'users', 'departments'));
    }

    public function store(Request $request)
    {
        if($request->password != $request->cpassword){
            return redirect()->back()->with('error', 'Password does not match!');
        }
        if(strlen($request->password) < 8){
            return redirect()->back()->with('error', 'Password should not be less than eight characters long!');
        }
        $user = new User();
        $user->email = $request->email;
        $user->phone_number = $request->phone;
        $user->password = Hash::make($request->password);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        if ($user->save()) {
            $examOfficer = new ExamOfficer();
            $examOfficer->user_id = $user->id;
            $examOfficer->department_id = $request->department_id;

            if ($examOfficer->save()) {
                return redirect()->back()->with('success', 'Exam Officer added successfully!');
            } else {
                // Rollback user creation if exam officer creation fails
                $user->delete();
                return redirect()->back()->with('error', 'Failed to create Exam Officer!');
            }
        }

        return redirect()->back()->with('error', 'Failed to create exam officer...');
    }

}
