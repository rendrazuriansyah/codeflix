<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Disable foreign key constraints to prevent errors when truncating the "plans" table
        // since the "plans" table has a foreign key constraint to the "users" table.
        Schema::disableForeignKeyConstraints();

        // Truncate the "plans" table
        DB::table('plans')->truncate();

        // Define the plans
        $plans = [
            [
                'title' => 'Basic',
                'price' => '49999',
                'resolution' => '720p',
                'max_devices' => 1,
                'duration' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Standard',
                'price' => '89999',
                'resolution' => '1080p',
                'max_devices' => 2,
                'duration' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Premium',
                'price' => '129999',
                'resolution' => '4k',
                'max_devices' => 4,
                'duration' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the plans into the database
        DB::table('plans')->insert($plans);

        // Enable foreign key constraints again, so that the foreign key constraints are enforced
        // for any subsequent database operations.
        Schema::enableForeignKeyConstraints();
    }
}
