<?php

namespace App\Http\Controllers;

use App\User;
use App\Entry;
use App\HiddenTweet;
use App\Challenge\Twitter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function author($id)
    {
        $user = User::findOrFail($id);
        $entries = $user->entries()->orderBy('created_at', 'desc')->paginate(3);

        return view('site.author', compact('user', 'entries'));
    }

    /**
     * Get twitter data from specific user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tweets($userId) 
    {
        $user = User::findOrFail($userId);

        $hiddenTweetsIds = $user->hiddenTweets()->pluck('tweet_id')->toArray();
        $isTwitterOwner = Auth::check() && $user->id===Auth::id();

        $twitter = new Twitter();
        $tweets = $twitter->getTweets($user->twitter_username, $hiddenTweetsIds, !$isTwitterOwner);

        $response = [ 
                        'username' => $user->twitter_username,
                        'isOwner' => $isTwitterOwner,
                    ];
        
        if ($tweets!==false) {
            $response['tweets'] = $tweets;
        } else {
            $response['errors'] = $twitter->getErrors();
        }
        
        return response()->json($response);
    }

    /**
     * Get twitter data from specific user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tweetUpdate(Request $request, $tweetId) 
    {
        $success = false;
        if (Auth::check()) {
            $hiddenTweet = HiddenTweet::firstOrNew(['user_id' => Auth::id(), 'tweet_id'=>$tweetId]);
            if ($request->input('hide')) {
                $success = $hiddenTweet->save();
            } else {
                $success = $hiddenTweet->delete();
            }
        }

        return response()->json( ['success' => $success ] );
    }
}
