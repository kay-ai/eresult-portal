<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{

    public function index()
    {

    }

    public function store(Request $request)
    {
        $grade = new Grade();
        $grade->type = $request->type;
		$grade->from = $request->from;
		$grade->to = $request->to;
		$grade->rmk = $request->rmk;

        $check = Grade::where('type', $request->type)->count();

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
