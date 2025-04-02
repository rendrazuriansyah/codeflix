{{-- Loop through each movie in the movies collection --}}
@foreach ($movies as $movie)
    <div class="col-md-20 col-6">
        {{-- Link to the movie details page --}}
        <a href="{{ route('movies.show', $movie->slug) }}">
            <div class="mb-4 card">
                {{-- Display the movie poster --}}
                <img src="{{ $movie->poster }}" class="card-image-movie-list" alt="Movie poster for {{ $movie->title }}">
                {{-- Display the movie's average rating --}}
                <span class="badge rounded-pill text-bg-dark badge-rating">
                    <img class="star-rating" src="{{ asset('assets/img/star-rating.png') }}" alt="Star rating icon">
                    ({{ $movie->average_rating }})
                </span>
            </div>
        </a>
    </div>
@endforeach
