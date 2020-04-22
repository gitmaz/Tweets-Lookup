<?php

namespace App\Http\Middleware;

use Closure;

//any route that consumes our api should pass through this middleware ( to enforce basic oauth authentication)
class TokenRestriction
{
    protected $ValidTokens;

    private function setup()
    {

        $this->ValidTokens = [];

        $this->ValidTokens[] = env('TWIT_LOOKUP_LOCAL_API_AUTH_TOKEN');

        // add or remove tokens to grant or remove other site's access to our services here
        //$this->ValidTokens[] = env('TWIT_LOOKUP_CONSUMER_1_API_AUTH_TOKEN');


    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->setup();

        $authToken = $request->input('auth_token');

        if ($authToken == null || !in_array($authToken, $this->ValidTokens)) {
            return response()->json('Invalid Token', 403);
        }

        return $next($request);

    }
}
