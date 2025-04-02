@extends('layouts.app')

@section('content')
    {{-- Display the category name --}}
    <h3 class="category-title">Category: {{ $category->name }}</h3>

    {{-- List of movies in the category --}}
    <div class="row card-movie-list">
        @foreach ($movies as $movie)
            <div class="col-md-20 col-6">
                {{-- Link to the movie page --}}
                <a href="{{ route('movies.show', $movie->slug) }}">
                    <div class="mb-4 card">
                        {{-- Movie poster --}}
                        <img src="{{ $movie->poster }}" class="card-image-movie-list" alt="Image of {{ $movie->title }} movie">
                        {{-- Rating badge --}}
                        <span class="badge rounded-pill text-bg-dark badge-rating">
                            <img src="{{ asset('assets/img/star-rating.png') }}" alt="Rating icon" class="star-rating">
                            {{-- Average rating --}}
                            ({{ $movie->average_rating }})
                        </span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
