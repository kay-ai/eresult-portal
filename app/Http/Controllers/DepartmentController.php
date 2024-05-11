<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Faculty;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::all();
        $faculties = Faculty::all();
        return view('superAdmin.departments', compact('departments', 'faculties'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'hod' => 'required|string|max:255',
            'signature' => 'required|file|mimes:png,jpg,jpeg,pdf|max:2048'
        ]);

        if ($request->hasFile('signature')) {
            $file = $request->file('signature');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('signatures', $fileName, 'public');

            $department = new Department();
            $department->name = $validatedData['name'];
            $department->hod = $validatedData['hod'];
            $department->signature = $filePath;
            $department->faculty_id = $request->faculty_id;
            $department->save();

            return redirect()->back()->with('success', 'Department created successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload signature file.');
    }

    public function edit()
    {

    }

    public function update(Request $request)
    {

    }
}
