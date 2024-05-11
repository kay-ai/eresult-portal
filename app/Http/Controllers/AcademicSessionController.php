<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicSession;

class AcademicSessionController extends Controller
{
    public function index()
    {
        $sessions = AcademicSession::latest()->get();
        return view('superAdmin.academicSessions', compact('sessions'));
    }

    public function store(Request $request)
    {

        $title = $request->input('title');

        $session = new AcademicSession();

        $session->title = $title;

        $check = AcademicSession::where('title', $request->name)->count();

        if($check > 0)
        {
            return redirect()->back()->with('error', 'Academic Session already exists!');
        }

        if ($session->save()) {
            return redirect()->back()->with('success', 'Session added successfully!');
        } else {
            return redirect()->back()->with('error', 'No file selected!');
        }

    }

    public function update(Request $request)
    {

    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $session = AcademicSession::find($id);
        if($session->delete())
        {
            return redirect()->back()->with('success', 'Academic Session deleted successfully!');
        }
    }
}
