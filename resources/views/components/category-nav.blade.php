<ul class="mb-2 navbar-nav me-auto mb-lg-0">
    <!-- Dropdown for categories -->
    <li class="nav-item dropdown kategori-dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Category <!-- Category label -->
        </a>
        <div class="dropdown-menu">
            <!-- Loop through the list of categories, split into chunks -->
            @foreach ($categories as $chunk)
                <ul>
                    <!-- Loop through each category in the chunk -->
                    @foreach ($chunk as $category)
                        <!-- category item -->
                        <li>
                            <!-- Create a link to the category page -->
                            <a class="dropdown-item" href="{{ route('categories.show', $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </li>
    <!-- Movies navigation item -->
    <li class="nav-item">
        <!-- Link to the movies index page -->
        <a class="nav-link text-white" href="{{ route('movies.index') }}">
            Movies <!-- Movies label -->
        </a>
    </li>
</ul>
