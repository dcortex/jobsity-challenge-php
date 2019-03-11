<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $rules = [  
                    'name' => ['required', 'string', 'max:255'],
                    'twitter_username' => ['required', 'string', 'min:3', 'max:15', 'alpha_dash'],
                 ];
        if ($request->filled('password')) {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }

        $validatedData = $request->validate($rules);
        $input = $request->only(array_keys($rules));

        if (isset($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        }

        $user->update($input);

        return redirect('/');
    }

}
