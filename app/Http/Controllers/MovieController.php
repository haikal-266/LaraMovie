<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\TmdbService;

class MovieController extends Controller
{
    protected $tmdbService;

    public function __construct(TmdbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function index(Request $request)
    {
        $query = $request->input('query');
        
        if ($query) {
            $movies = $this->tmdbService->searchMovies($query);
        } else {
            $movies = $this->tmdbService->getPopularMovies();
        }
        
        return view('movies.index', compact('movies', 'query'));
    }
}