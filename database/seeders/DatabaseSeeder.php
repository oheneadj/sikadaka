<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Contributor;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Institution;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create();
        //Institution::factory(1)->create();
        //Contributor::factory(1000)->create();
        //Payment::factory(1000)->create();
        $this->call([
            ProjectSeeder::class,
        ]);


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
