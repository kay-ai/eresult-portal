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
}
