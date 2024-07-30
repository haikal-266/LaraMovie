<?php

namespace App\Services;

use GuzzleHttp\Client;

class TmdbService
{
    protected $client;
    protected $apiKey;
    
    public function getUpcomingMovies()
    {
        $response = $this->client->get('https://api.themoviedb.org/3/movie/upcoming', [
            'query' => [
                'api_key' => $this->apiKey,
                'language' => 'en-US',
                'page' => 1
            ]
        ]);

        return json_decode($response->getBody(), true)['results'];
    }


    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('TMDB_API_KEY');
    }

    public function getPopularMovies()
    {
        $response = $this->client->get('https://api.themoviedb.org/3/movie/popular', [
            'query' => [
                'api_key' => $this->apiKey,
                'language' => 'en-US',
                'page' => 1
            ]
        ]);

        return json_decode($response->getBody(), true)['results'];
    }

    public function searchMovies($query)
    {
        $response = $this->client->get('https://api.themoviedb.org/3/search/movie', [
            'query' => [
                'api_key' => $this->apiKey,
                'query' => $query,
                'language' => 'en-US',
                'page' => 1
            ]
        ]);

        return json_decode($response->getBody(), true)['results'];
    }
}
