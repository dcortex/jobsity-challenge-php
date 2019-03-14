<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
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
        $entries = Auth::user()->entries()->orderBy('created_at', 'desc')->get();
        return view('entries.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
        ]);
        
        $entry = Entry::create(['user_id'=>Auth::id(), 'title' => $request->title,'content' => $request->content]);
        return redirect('/entries')->with('success', 'Entry was successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entry = Entry::where('user_id', Auth::id())->findOrFail($id);

        return view('entries.show',compact('entry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entry = Entry::where('user_id', Auth::id())->findOrFail($id);
        
        return view('entries.edit', compact('entry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validate
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
        ]);
        
        Entry::where('user_id', Auth::id())->findOrFail($id)->update($validatedData);

        return redirect('/entries')->with('success', 'Entry was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entry = Entry::where('user_id', Auth::id())->findOrFail($id);
        $entry->delete();

        return redirect('/entries')->with('success', 'Entry was successfully deleted');
    }
    
}
