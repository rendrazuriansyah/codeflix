<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;

class MovieController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            'auth',
            'check.device.limit',
        ];
    }

    public function index() 
    {
        $newAddedMovies = Movie::latest()->limit(8)->get();
        $topRatedMovies = Movie::with('ratings')
            ->get()
            ->sortByDesc('average_rating')
            ->take(8);
    
        return view('movies.index',[
            'newAddedMovies' => $newAddedMovies,
            'topRatedMovies' => $topRatedMovies,
        ]);
    }

    public function show(Movie $movie) 
    {
        $userPlan = Auth::user()->getCurrentPlan();
        $streamingUrl = $movie->getStreamingUrl($userPlan->resolution);

        return view('movies.show', [
            'movie' => $movie,
            'streamingUrl' => $streamingUrl,
        ]);
    }
}
