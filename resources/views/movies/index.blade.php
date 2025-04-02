@extends('layouts.app')

@section('content')

    <!-- Jumbotron Section -->
    <div class="container-fluid section-jumbotron">
        <!-- Jumbotron component -->
        <div class="jumbotron">
            <div class="jumbotron-content">
                <div class="row align-items-center">
                    <div class="col-md-5 col-7">
                        <!-- Jumbotron content -->
                        <div class="py-4 ms-4">
                            <h1 class="display-4 jumbotron-title">All New Simba</h1>
                            <!-- Jumbotron title -->
                            <p class="lead">
                                <!-- Jumbotron description -->
                                Simba is a lonely cub searching for his parents, but his efforts are limited.
                                Can Simba find his parents?
                            </p>
                            <!-- Jumbotron button -->
                            <a class="btn btn-primary btn-play btn-md-lg" href="#" role="button">Play</a>
                        </div>
                    </div>
                    <div class="col-md-7 col-5 jumbotron-img">
                        <!-- Jumbotron image -->
                        <div class="jumbotron-layer"></div>
                        <img src="assets/img/Jumbotron-img.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section title -->
    <h3 class="new-added-title">
        <!-- Text -->
        New Added
    </h3>

    <section>
        <!-- Swiper Container -->
        <div class="swiper">
            <!-- Wrapper for Slides -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach ($newAddedMovies as $movie)
                    <div class="swiper-slide">
                        <div class="card">
                            <a href="{{ route('movies.show', $movie->slug) }}">
                                <!-- Image for Slides -->
                                <img src="{{ $movie->poster }}" class="img-fluid h-100" alt="Movie Image">
                                <!-- Rating Badge -->
                                <span class="badge rounded-pill text-bg-dark badge-rating">
                                    <img class="star-rating" src="assets/img/star-rating.png" alt="Star Rating">
                                    ({{ $movie->average_rating }})
                                </span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination Controls -->
            <div class="swiper-pagination"></div>

            <!-- Navigation Buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <!-- Scrollbar -->
            <div class="swiper-scrollbar"></div>
        </div>
    </section>

    <!-- Section title -->
    <h3 class="new-added-title">
        <!-- Text -->
        Top Rated
    </h3>
    
    <section>
        <!-- Swiper container -->
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach ($topRatedMovies as $movie)
                    <div class="swiper-slide">
                        <div class="card">
                            <!-- Image for Slides -->
                            <img src="{{ $movie->poster }}" class="img-fluid h-100" alt="Trex Image">
                            <!-- Rating Badge -->
                            <span class="badge rounded-pill text-bg-dark badge-rating">
                                <img class="star-rating" src="assets/img/star-rating.png" alt="Star Rating">
                                ({{ $movie->average_rating }})
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination Controls -->
            <div class="swiper-pagination"></div>

            <!-- Navigation Buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <!-- Scrollbar -->
            <div class="swiper-scrollbar"></div>
        </div>
    </section>
@endsection
