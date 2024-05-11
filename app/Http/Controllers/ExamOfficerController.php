<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamOfficer;
use App\Models\User;
use App\Models\Department;

class ExamOfficerController extends Controller
{
    public function index(){
        $examOfficers = ExamOfficer::all();
        $users = User::all();
        $departments = Department::all();
        return view('superAdmin.examOfficers', compact('examOfficers', 'users', 'departments'));
    }

    public function store(Request $request){
        $examOfficer = new ExamOfficer();
        $examOfficer->user_id = $request->user_id;
        $examOfficer->department_id = $request->department_id;

        if($examOfficer->save())
        {
            return redirect()->back()->with('success', 'Exam Officer added successfully!');
        }

        return redirect()->back()->with('success', 'The server is unable to handle your request at the moment!');
    }
}
