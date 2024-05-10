<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;

class FacultyController extends Controller
{
    public function index(){
        $faculties = Faculty::latest()->get();
        return view('superAdmin.faculty', compact('faculties'));
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $dean = $request->input('dean');

        $existingFaculty = Faculty::where('name', $name)->first();

        if ($existingFaculty) {
            return redirect()->back()->with('error', 'Faculty with the same name already exists!');
        }

        $faculty = new Faculty();
        $faculty->name = $name;
        $faculty->dean = $dean;

        if ($faculty->save()) {
            return redirect()->back()->with('success', 'Faculty added successfully!');
        } else {
            return redirect()->back()->with('error', 'The server was unable to handle your request at the moment!');
        }
    }

    public function update(Request $request)
    {

    }

    public function destroy(Request $request)
    {

    }
}
