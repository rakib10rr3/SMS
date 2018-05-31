<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function index()
    {
        return view('recovery_password.index');
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => 'required|regex:/[A-Z0-9]+/',
            'pass' => 'required|regex:/[a-zA-Z0-9]+/|max:50',
        ];

        $customMessages = [
            'name.required' => 'Username is required',
            'name.regex' => 'Username must contain only Capital Letters and Numbers',
            'pass.required' => 'Password is required',
            'pass.regex' => 'Password must contain only Capital or Small Letters and Numbers',
            'pass.max' => 'Password cannot greater than 50 characters long',
        ];

        $this->validate($request, $rules, $customMessages);

        $user = User::query()->where('username', '=', $request->name)->first();

        if (!empty($user)) {
            $user->password = bcrypt($request->pass);
            $user->save();

            return redirect()->route('recovery.password.index')->with('status', 'Password Change Successful for ID: ' . $request->name);
        } else {
            return redirect()->route('recovery.password.index')->withErrors(['message' => 'No user found with ID: ' . $request->name]);
        }

    }
}
