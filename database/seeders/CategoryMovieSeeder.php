<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Seeds the pivot table for the many-to-many relationship between categories and movies.
 */
class CategoryMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * This seeder will truncate the pivot table and then insert new records.
     * It will assign a random number of categories (between 1 and 3) to each movie.
     */
    public function run(): void
    {
        // Disable foreign key constraints to avoid issues when truncating the table
        Schema::disableForeignKeyConstraints();

        // Truncate the pivot table
        DB::table('category_movie')->truncate();

        // Fetch all category and movie IDs
        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        $movieIds = DB::table('movies')->pluck('id')->toArray();

        // Loop through each movie and assign a random number of categories
        foreach ($movieIds as $movieId) {
            // Get a random number of categories (between 1 and 3)
            $randomCategories = array_rand($categoryIds, rand(1, 3));

            // Ensure the result is an array
            $randomCategories = (array) $randomCategories;

            // Loop through the selected categories and insert a new record in the pivot table
            foreach ($randomCategories as $categoryId) {
                DB::table('category_movie')->insert([
                    // Use the selected category ID
                    'category_id' => $categoryIds[$categoryId],
                    // Use the current movie ID
                    'movie_id' => $movieId,
                    // Set the timestamps
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}

