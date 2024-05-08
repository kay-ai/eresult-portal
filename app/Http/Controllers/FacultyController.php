<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;

class FacultyController extends Controller
{
    public function index(){
        $faculties = Faculty::all();
        return view('superAdmin.faculty', compact('faculties'));
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $country = $request->input('country');
        $state = $request->input('state');
        $motto = $request->input('motto');
        $password = md5($request->input('password'));
        $email = $request->input('email');
        $schlPobox = $request->input('schlPobox');
        $exam_officer = $request->input('exam_officer');
        $department = $request->input('department');

        $today = now();

        if ($request->hasFile('logo')) {
            // Handle logo upload
            $logo = $request->file('logo');
            $logoPath = $logo->store('logos', 'public');
            $uf_name = $logo->hashName();

            $accountExists = DB::table('account')->where('email', $email)->exists();

            if (!$accountExists) {
                DB::table('account')->insert([
                    'school' => $name,
                    'state' => $state,
                    'department' => $department,
                    'pob' => $schlPobox,
                    'email' => $email,
                    'password' => $password,
                    'logo' => $uf_name,
                    'motto' => $motto,
                    'exam_officer' => $exam_officer,
                    'created_at' => $today,
                    'updated_at' => $today,
                ]);

                return redirect()->route('dashboard')->with('success', 'Account created successfully!');
            } else {
                DB::table('account')->where('email', $email)->update([
                    'school' => $name,
                    'state' => $state,
                    'department' => $department,
                    'pob' => $schlPobox,
                    'logo' => $uf_name,
                    'motto' => $motto,
                    'exam_officer' => $exam_officer,
                    'updated_at' => $today,
                ]);

                return redirect()->route('dashboard')->with('success', 'Account updated successfully!');
            }
        } else {
            // Handle update without logo
            $accountExists = DB::table('account')->where('email', $email)->exists();

            if (!$accountExists) {
                DB::table('account')->insert([
                    'school' => $name,
                    'state' => $state,
                    'department' => $department,
                    'pob' => $schlPobox,
                    'email' => $email,
                    'password' => $password,
                    'motto' => $motto,
                    'exam_officer' => $exam_officer,
                    'created_at' => $today,
                    'updated_at' => $today,
                ]);

                return redirect()->route('dashboard')->with('success', 'Account created successfully!');
            } else {
                DB::table('account')->where('email', $email)->update([
                    'school' => $name,
                    'state' => $state,
                    'department' => $department,
                    'pob' => $schlPobox,
                    'motto' => $motto,
                    'exam_officer' => $exam_officer,
                    'updated_at' => $today,
                ]);

                return redirect()->route('dashboard')->with('success', 'Account updated successfully!');
            }
        }
    }

    public function update(Request $request)
    {

    }

    public function destroy(Request $request)
    {

    }
}
