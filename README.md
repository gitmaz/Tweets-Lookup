## About Tweets-Lookup

Tweets-Lookup is a demo application that shows how to consume a twitter api endpoint, query keywords in all twitts and finally, render results nicely on the frond end.  

It also exposes an api endpoint for external websites to consume this same result set, using simple authentication (basic oauth).

Key technologies:

- Laravel 7.6.2 (backend and api)
- Vue.Js -Vue/Cli 4.3.1 (front end)
- j7mbo/twitter-api-php (third party php library which uses curl internally to communicate with twitter api)
- Phpunit 8.5 (for testing successful integration of above library into laravel and also adding a new test case)

This application is developed to return an example query into twitter.com twits (all twitts mentioning "Kidspot" as an example). But it can be used
as a boilerplate to create applications that do more interactions (read/write) with twitter through other available twitter api endpoints.

Laravel is used because of its neatly structured framework pattern to create api end points in MVC which is easily extensible and maintainable.
Vue.js is used to be able to easily expand the ui for future development in an object oriented manner (Open close principal in SOLID).

#### How to install

After cloning this code repository to your local computer and changing directory to the created folder, run fallowing commands on the console:
(first make sure php, composer and npm are installed on your computer)

1. composer install
2. npm install
3. npm run dev


#### How to run
 
For ease of use, .env file in the root folder is included in git.
  This file is defining twitter developer consumer keys that I have registered by creating an app in their developer website (https://developer.twitter.com/en/apps). 

This will soon be obselete. You need to create your own tokens there in Keys and tokens tabs in Consumer API Keys and Access token section and edit the fallowing keys in .env accordingly:

TWITTER_CONSUMER_KEY=  
TWITTER_CONSUMER_SECRET=  
TWITTER_OAUTH_ACCESS_TOKEN=  
TWITTER_OAUTH_ACCESS_TOKEN_SECRET=  

Note: (laravel app local environment configuration which should be kept local and not be saved to repository should be git ignored on your forks)

To run, do fallowing on the console/browser:

1. php artisan serve
2. open your browser and goto http://localhost:8000 (or any port that above command denotes), you now should be able to see a list of twitts with their hashtags and mentions

#### Consuming Tweet-Lookup api endpoint
Tweet-Lookup also exposes a new api endpoint to other websites based on basic authentication
(http://localhost:8000/api/v1/search-referring-tweets).

Simply generate a 24 character hash and uncomment lines in the code that references TWIT_LOOKUP_CONSUMER_1_API_AUTH_TOKEN.

For example TWIT_LOOKUP_CONSUMER_1_API_AUTH_TOKEN="5ueWJbSvd3Du6StxZWx5cdx2".

To test demo version endpoint you can browse  
http://localhost:8000/api/v1/search-referring-tweets?auth_token=5ueWJbSvd3Du6StxZWx5cdx1   
(after running local server )

For making things secure, you need to access this url (with your newly generated token) through ssl (and through a server to server curl).

#### Unit tests

A simple test case is added to test new twitter search endpoint as an extra case called  testCanSearchTweets() in TwitterAPIExchangeTest.php 
which is borrowed from j7mbo/twitter-api-php.

To run the test case run this on the console:

vendor/bin/phpunit --filter testCanSearchTweets TwitterAPIExchangeTest ./tests/Unit/TwitterAPIExchangeTest.php 
 

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
This source code is based on this and all other open source vendor copyrights. Users are granted the right to copy/modify and distribute Tweet-Lookup
by keeping all included library's copyright details.

- Author:
Maziar Navabi  
23/04/2020


