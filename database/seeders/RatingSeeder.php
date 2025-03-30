<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        
        DB::table('ratings')->truncate();

        // Peringatan: Mengambil semua data dari tabel movie dan user.
        // Jika data terlalu banyak, bisa menyebabkan lag.
        $movies = Movie::all();
        $users = User::all();

        $ratings = [];

        // Loop through all movies and users
        foreach ($movies as $movie) {
            foreach ($users as $user) {
                $rating = rand(1, 10);
                // $rating = fake()->randomFloat(1, 0, 10); // biar bisa langsung diperview rating decimal nya dlu

                $ratings[] = [
                    'user_id' => $user->id,
                    'movie_id' => $movie->id,
                    'rating' => $rating,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('ratings')->insert($ratings);

        Schema::enableForeignKeyConstraints();
    }
}
