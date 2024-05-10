<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function index(){
        $account = Account::first();
        return view('superAdmin.setup', compact('account'));
    }

    public function update(Request $request){

        $id = $request->id;

        $account = Account::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'school' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pob' => 'required|string|max:8',
            'motto' => 'required|string|max:255',
            'email' => 'required|email|max:30',
            'phone' => 'required|string|max:16',
            'address' => 'required|string|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update the account with the validated data
        try{
            $account->update($validatedData);
        }catch(\Exception $e){
            return redirect()->back()->with('success', $e->getMessage());
        }

        // Handle logo upload if a new logo was provided
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logo', 'public');
            $account->logo = $logoPath;
            $account->save();
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'School information updated successfully.');

    }

}
