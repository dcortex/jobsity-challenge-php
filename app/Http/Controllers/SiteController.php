<?php

namespace App\Http\Controllers;

use App\User;
use App\Entry;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $entries = Entry::orderBy('created_at', 'desc')->paginate(3);

        return view('site.home', compact('entries'));
    }

    /**
     * Display a public profile from specific user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $user = User::findOrFail($id);
        $entries = $user->entries;

        return view('site.profile', compact('user', 'entries'));
    }
}
