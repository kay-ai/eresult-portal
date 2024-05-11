<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::latest()->get();
        return view('superAdmin.levels', compact('levels'));
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
