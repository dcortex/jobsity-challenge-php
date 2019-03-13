<?php

namespace App\Challenge;

use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter
{
    /** @var TwitterOAuth Twitter API connection */
    private $connection;
    private $errors = [];

    public function __construct()
    {
        $this->connection = new TwitterOAuth(
                env('TWITTER_CONSUMER_KEY'), 
                env('TWITTER_CONSUMER_SECRET'), 
                env('TWITTER_ACCESS_TOKEN'), 
                env('TWITTER_ACCESS_TOKEN_SECRET')
            );
        $this->connection->setTimeouts(10, 15);
    }

    /**
     * Get twitter timeline for a username
     *
     * @return array tweets info
     */
    public function getTweets($username, $hiddenTweetsIds = [], $filterHiddenTweets = false) 
    {
        $this->errors = [];
        if (empty($username)) return false;
        
        $response = $this->connection->get('statuses/user_timeline', ['screen_name' => $username]);

        // Detect errors
        if ($this->connection->getLastHttpCode() !== 200) {
            if (isset($response->error)) {
                $this->errors[] = ['code' => $this->connection->getLastHttpCode(), 'message' => $response->error ?? 'Unkown Error'];
            } elseif (isset($response->errors)) {
                $this->errors = array_merge($this->errors, array_map(['App\Challenge\Twitter', 'objectToArray'], $response->errors));
            }
            return false;
        }
        
        $tweets = array_map(function($tweet) use ($hiddenTweetsIds) {
                $tmpTweet = $this->objectToArray($tweet);   // Convert to associative array
                $tmpTweet['hidden'] = in_array($tmpTweet['id_str'], $hiddenTweetsIds, false);   // Mark hidden tweets
                return $tmpTweet;
            }, $response);

        if ($filterHiddenTweets) {
            $tweets = array_values(
                array_filter($tweets, function($tweet) {
                    return !$tweet['hidden'];
                })
            );
        }

        return $tweets;
    }

    public function getErrors() 
    {
        return $this->errors;
    }

    private function objectToArray($o) 
    {
        return (array)$o;
    }
}
