<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Department;
use App\Models\Level;
use App\Models\Result;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::latest()->get();
        $students = Student::latest()->get();
        $results = Result::latest()->get();
        $studentCount = count($students);
        $resultCount = count($results);

        $levels = Level::all();
        $departments = Department::all();
        $sessions = AcademicSession::all();

        return view('dashboard', compact('levels', 'departments', 'sessions', 'users','students','studentCount','resultCount'));
    }

    public function admin()
    {
        $users = User::latest()->get();
        return view('superAdmin.index', compact('users'));
    }
}
