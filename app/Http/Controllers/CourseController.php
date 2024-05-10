<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
		$levels = Level::all();
		$courses = Course::all();
		return view('courses', compact('levels', 'courses'));
    }

    public function store(Request $request)
    {
        $course = new Course();
        $course->title = $request->title;
		$course->unit = $request->unit;
		$course->code = $request->code;
		$course->type = $request->type;
		$course->level_id = $request->level;
		$course->semester = $request->semester;

        $check = Course::where('title', $request->title)->count();

		if($check > 1){
			return redirect()->back()->with('error', 'Course already exists!');
		}else{
            if($course->save())
            {
                return redirect()->back()->with('success', 'Course added successfully!');
            }
        }
    }

    public function edit(Request $request)
    {
        return view('editCourse');
    }

    public function update(Request $request)
    {
        $course = Course::find($request->course_id);
        $course->name = $request->name;
		$course->unit = $request->unit;
		$course->code = $request->code;
		$course->type = $request->type;
		$course->level_id = $request->level;
		$course->semester = $request->semester;

        if($course->save())
        {
            return redirect()->back()->with('success', 'Course updated successfully!');
        }

        return redirect()->back()->with('error', 'The server was unable to handle your query!');
    }

    public function destroy(Request $request)
    {
        $course = Course::find($request->course_id);
        if($course){
            $course->delete();
            return redirect()->back()->with('success', 'Course deleted successfully!');
        }
    }
}
