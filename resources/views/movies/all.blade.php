@extends('layouts.app')

@section('content')
    <h3 class="category-title">Movies</h3>
    <!-- Movie list container -->
    <div class="row card-movie-list" id="movie-list">
        <!-- Load movies list component -->
        <x-movie-list :movies="$movies" />
    </div>
    <!-- Load more button container -->
    <div class="text-center">
        <!-- Load more button -->
        <button type="button" class="mb-4 btn btn-outline-success load-more" id="load-more" data-page="2">
            <!-- Rotate right icon -->
            <i class="fa-solid fa-rotate-right rotate-right"></i>
            <!-- Button text -->
            Load More
        </button>
    </div>
@endsection

@push('scripts')
    <script>
        /**
         * Initializes the load more feature for the movies list.
         * When the load more button is clicked, it fetches the next page of movies and appends it to the list.
         * If there are no more pages, it hides the button.
         */
        document.addEventListener('DOMContentLoaded', function() {
            // Get the load more button
            let loadMoreBtn = document.querySelector('#load-more');

            // Add event listener to the button
            loadMoreBtn.addEventListener('click', function() {
                // Get the current page
                let page = loadMoreBtn.getAttribute('data-page');

                // Fetch the next page of movies
                fetch(`/movies?page=${page}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Get the movie list container
                        let movieList = document.querySelector('#movie-list');

                        // Append the new movies to the list
                        movieList.insertAdjacentHTML('beforeend', data.html);

                        // Update the page for the next load
                        loadMoreBtn.setAttribute('data-page', parseInt(page) + 1);

                        // Hide the button if there are no more pages
                        if (!data.next_page) {
                            loadMoreBtn.style.display = 'none';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endpush
