<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class TweetApiController extends Controller
{
    public function followers()
    {
        $client = new \GuzzleHttp\Client();
        $id = 2244994945;
        $endpoint = "https://api.twitter.com/2/users/{$id}/followers";

        try {
            $response = $client->request('GET', $endpoint, ['headers' => [
                'authorization' =>
                'Bearer aFNqQnNMaUMwWVI5Nm1OUkp3TndINUh2aEsxRWFJeXhva1Z3N3E3aVR4VEVoOjE2NjQ5NDc0Mzk4ODU6MToxOmF0OjE'
            ]]);
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $content = json_decode($response->getBody(), true);
                $followers = $content['data'];
                dd($followers);
            } else {
                if (env('APP_DEBUG')) {
                    dd($statusCode);
                } else {
                    echo "Error!";
                }
            }
        } catch (Exception $e) {
            if (env('APP_DEBUG')) {
                echo $e->getMessage();
            } else {
                echo "Error!";
            }
        }
    }

    public function tweets()
    {
        $client = new \GuzzleHttp\Client();
        $id = 2244994945;
        $endpoint = "https://api.twitter.com/2/users/{$id}/tweets";

        try {
            $response = $client->request('GET', $endpoint, ['headers' => [
                'authorization' =>
                'Bearer aFNqQnNMaUMwWVI5Nm1OUkp3TndINUh2aEsxRWFJeXhva1Z3N3E3aVR4VEVoOjE2NjQ5NDc0Mzk4ODU6MToxOmF0OjE'
            ]]);
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                $content = json_decode($response->getBody(), true);
                $tweets = $content['data'];
                dd($tweets);
            } else {
                if (env('APP_DEBUG')) {
                    dd($statusCode);
                } else {
                    echo "Error!";
                }
            }
        } catch (Exception $e) {
            if (env('APP_DEBUG')) {
                echo $e->getMessage();
            } else {
                echo "Error!";
            }
        }
    }

    public function likes()
    {
        $client = new \GuzzleHttp\Client();
        $id = 2244994945;
        $endpoint1 = "https://api.twitter.com/2/users/{$id}/tweets";
        $count = 0;

        try {
            $response1 = $client->request('GET', $endpoint1, ['headers' => [
                'authorization' =>
                'Bearer aHhUUDFtT29sSldBbFJoVm05ZktfbWNERDJkRVFEb3dQLV9rbTVXcWZBdVVZOjE2NjQ5NTQ0MTIwMTE6MTowOmF0OjE'
            ]]);
            $statusCode1 = $response1->getStatusCode();

            if ($statusCode1 == 200) {
                $content1 = json_decode($response1->getBody(), true);
                $tweets = $content1['data'];
                foreach ($tweets as $key => $tweet) {
                    $endpoint2 = "https://api.twitter.com/2/tweets/{$tweet['id']}/liking_users";
                    try {
                        $response2 = $client->request('GET', $endpoint2, ['headers' => [
                            'authorization' =>
                            'Bearer aHhUUDFtT29sSldBbFJoVm05ZktfbWNERDJkRVFEb3dQLV9rbTVXcWZBdVVZOjE2NjQ5NTQ0MTIwMTE6MTowOmF0OjE'
                        ]]);
                        $statusCode2 = $response2->getStatusCode();

                        if ($statusCode2 == 200) {
                            $content2 = json_decode($response2->getBody(), true);
                            $likes = $content2['data'];
                            $count += count($likes);
                        } else {
                            if (env('APP_DEBUG')) {
                                dd($statusCode2);
                            } else {
                                echo "Error!";
                            }
                        }
                    } catch (Exception $e) {
                        if (env('APP_DEBUG')) {
                            echo $e->getMessage();
                        } else {
                            echo "Error fetching likes!";
                        }
                    }
                }
                echo 'Total likes: ' . $count;
            } else {
                if (env('APP_DEBUG')) {
                    dd($statusCode1);
                } else {
                    echo "Error!";
                }
            }
        } catch (Exception $e) {
            if (env('APP_DEBUG')) {
                echo $e->getMessage();
            } else {
                echo "Error fetching tweets!";
            }
        }
    }
}
