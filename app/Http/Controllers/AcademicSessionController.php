<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcademicSessionController extends Controller
{
    public function index()
    {
        $sessions = AcademicSession::latest()->get();
        return view('academicSessions', compact('sessions'));
    }

    public function store(Request $request)
    {

        $title = $request->input('title');
        $hod = $request->input('hod_name');

        if ($request->hasFile('signature')) {
            $file = $request->file('signature');
            $fileSize = $file->getSize();

            if ($fileSize > 100000) {
                return response()->json(['status' => 'File is more than 100kb!']);
            }

            $fileExtension = $file->getClientOriginalExtension();
            $rand = rand();
            $directory = 'assets/app-contents/hod_signature';
            $fileName = "hod-{$rand}.{$fileExtension}";

            $file->move($directory, $fileName);

            $session = new AcademicSession();
            $session->title = $title;
            $session->hod = $hod;
            $session->signature = $fileName;

            try {
                $session->save();

                return redirect()->back()->with('success', 'Academic session created successfully!');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to create academic session.');
            }
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
