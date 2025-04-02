@extends('layouts.app')

@section('content')
    {{-- Display the search keyword --}}
    <h3 class="category-title">Keyword : {{ $keyword }}</h3>
    
    {{-- List of movies related to the search keyword --}}
    <div class="row card-movie-list">
        @foreach ($movies as $movie)
            <div class="col-md-20 col-6">
                {{-- Link to detailed movie page --}}
                <a href="{{ route('movies.show', $movie->slug) }}">
                    <div class="mb-4 card">
                        {{-- Movie poster image --}}
                        <img src="{{ $movie->poster }}" class="card-image-movie-list" alt="Movie poster for {{ $movie->title }}">
                        {{-- Movie rating badge --}}
                        <span class="badge rounded-pill text-bg-dark badge-rating">
                            <img class="star-rating" src="{{ asset('assets/img/star-rating.png') }}" alt="Star rating icon">
                            {{-- Display average rating --}}
                            ({{ $movie->average_rating }})
                        </span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
