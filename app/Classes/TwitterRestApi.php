<?php

namespace App\Classes;

class TwitterRestApi
{

    private static $_api_url = null;
    private static $_instance = null;
    private static $_twitterApiExchange = null;

    public function __construct(string $url, array $settings)
    {
        self::$_api_url = $url;
        self::$_twitterApiExchange = new \TwitterAPIExchange($settings);
    }

    /**
     * Connect()
     *  Kick off Rest API by setting up appropriate settings.
     *
     * @return TwitterRestApi|null
     */
    static function Connect()
    {

        //dd("here");
        $url = '';
        if (self::$_instance === null) {

            $url = env('TWITTER_API_URL');
            $settings = ["consumer_key" => env('TWITTER_CONSUMER_KEY'),
                "consumer_secret" => env('TWITTER_CONSUMER_SECRET'),
                "oauth_access_token" => env('TWITTER_OAUTH_ACCESS_TOKEN'),
                "oauth_access_token_secret" => env('TWITTER_OAUTH_ACCESS_TOKEN_SECRET')
            ];

        } else {
            return self::$_instance;
        }

        self::$_instance = new self(
            $url,
            $settings
        );


        return self::$_instance;
    }

    /**
     *  This function uses twitter standard api to search keywords
     *  it is similar when you do a https://twitter.com/search?q=$searchKeywords manually (replace $searchKeywords with your urlencoded, space separated search keywords)
     * @param array $tweetsArray array to acumulate found results
     * @param string $searchKeywords
     * @return array
     */
    public function searchTweets(&$tweetsArray, $searchKeywords, $maxId = -1)
    {

        $searchKeywords = urlencode($searchKeywords);
        $maxIdPhrase = ($maxId == -1 ? "" : "max_id=$maxId&");
        $twitsFound = self::$_twitterApiExchange->request(self::$_api_url, "GET", "?{$maxIdPhrase}q=$searchKeywords&count=100");
        $tweetsRaw = json_decode($twitsFound);
        $tweets = $tweetsRaw->statuses;

        foreach ($tweets as $tweet) {

            //this is temporarily commented out to find why all returned tweets are lacking hashtags
            /*if(count($tweet->entities->hashtags)==0){
                continue;
            }*/
            $tweetsArray[] = $tweet;
        }

        //if there is any next_results (extra tweet pages), find max_id as the starting tweet id  of next page tweets and fetch them)
        if (!empty($tweetsRaw->search_metadata->next_results)) {
            $nextResultsStr = $tweetsRaw->search_metadata->next_results;
            $matches = array();
            $t = preg_match('/max_id=(.*?)&/s', $nextResultsStr, $matches);

            $nextPageMaxId = -1;
            if (count($matches) > 0) {
                $nextPageMaxId = $matches[1];
                $this->searchTweets($tweetsArray, $searchKeywords, $nextPageMaxId);
            }
        }

        //dd($tweetsArray);
        //return $tweetsHavingHashtags;
    }
}
