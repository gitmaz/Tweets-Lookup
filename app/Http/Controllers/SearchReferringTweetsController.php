<?php

namespace App\Http\Controllers;

use App\Classes\TwitterRestApi;
use Illuminate\Http\Request;

class SearchReferringTweetsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $twitterRestApi = TwitterRestApi::Connect();
        $tweetsArray = [];
        $twitterRestApi->searchTweets($tweetsArray, "@KidspotSocial");
        //dd(json_decode($twitsFound));
        return json_encode($tweetsArray);
    }
}
