<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Codeflix</title>

    <!-- Load Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Load custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <!-- Load Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.6.0-web/css/all.css') }}">

    <!-- Load Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    <!-- Load navbar component -->
    <x-navbar />

    <!-- Load content section -->
    @yield('content')

    <!-- Load footer section -->
    <footer>
        <div class="text-center text-white">
            <p class="footer-title">&copy;
                <!-- Get the current year -->
                <script>
                    document.write(new Date().getFullYear());
                </script> RENDRADEV. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Load Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>

    <!-- Load Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        // Create a new Swiper instance
        const swiper = new Swiper('.swiper', {
            // Set the speed of the animation
            speed: 400,

            // Set the space between each slide
            spaceBetween: 10,

            // Set the autoplay feature
            autoplay: {
                // Set the delay between each slide
                delay: 3000, // 3 seconds

                // Disable autoplay when the user interacts with the slide
                disableOnInteraction: false,
            },

            // Set the pagination feature
            pagination: {
                // Set the pagination element
                el: '.swiper-pagination',

                // Set the type of pagination
                type: 'bullets',

                // Make the pagination clickable
                clickable: true,
            },

            // Set the navigation feature
            navigation: {
                // Set the next button element
                nextEl: '.swiper-button-next',

                // Set the previous button element
                prevEl: '.swiper-button-prev',
            },

            // Set the breakpoints for responsive design
            breakpoints: {
                // For screens with a width of 325px or less
                325: {
                    // Show 2 slides per view
                    slidesPerView: 2,

                    // Set the space between each slide
                    spaceBetween: 20,
                },

                // For screens with a width of 768px or less
                768: {
                    // Show 4 slides per view
                    slidesPerView: 4,

                    // Set the space between each slide
                    spaceBetween: 40,
                },

                // For screens with a width of 1024px or less
                1024: {
                    // Show 5 slides per view
                    slidesPerView: 5,

                    // Set the space between each slide
                    spaceBetween: 50,
                },
            },
        });
    </script>
    <!-- Stack any additional scripts that need to be loaded last -->
    @stack('scripts')
</body>

</html>
