<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $levelExists = Level::where('name', $name)->exists();

        if ($levelExists) {
            return redirect()->back()->with('error', 'Level already exists!');
        } else {
            $level = new Level();
            $level->name = $name;
            $level->created_at = now();

            try {
                $level->save();

                return redirect()->back()->with('success', 'Level added successfully!');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to add level.');
            }
        }
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
