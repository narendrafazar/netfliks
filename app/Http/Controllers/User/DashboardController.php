<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $featuredMovies = Movie::where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $movies = Movie::all();

        // return [
        //     'featuredMovies' => $featuredMovies,
        //     'movies' => $movies,    
        // ];

        return inertia('User/Dashboard/Index', [
            'featuredMovies' => $featuredMovies,
            'movies' => $movies,
        ]);
    }
}
