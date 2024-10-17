<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{

    public function index()
    {
        $grades = Grade::all();
        return view('superAdmin.grades', compact('grades'));
    }

    public function store(Request $request)
    {
        $grade = new Grade();
        $grade->_type = $request->type;
		$grade->_from = $request->from;
		$grade->_to = $request->to;
		$grade->rmk = $request->rmk;
		$grade->weight = $request->weight;

        $check = Grade::where('_type', $request->type)->count();

		if($check > 1){
			return redirect()->back()->with('error', 'Grade already exists!');
		}

        if($grade->save())
        {
            return redirect()->back()->with('success', 'Grade added successfully!');
        }
    }

    public function edit()
    {

    }

    public function update(Request $request)
    {
        $grade = Grade::find($request->grade_id);
        $grade->type = $request->type;
		$grade->from = $request->from;
		$grade->to = $request->to;
		$grade->rmk = $request->rmk;
		$grade->weight = $request->weight;

        if($grade->save())
        {
            return redirect()->back()->with('success', 'Grade updated successfully!');
        }
    }

    public function destroy(Request $request)
    {
        $grade = Grade::find($request->grade_id);
        if($grade)
        {
            $grade->delete();
            return redirect()->back()->with('success', 'Grade deleted successfully!');
        }
    }
}
