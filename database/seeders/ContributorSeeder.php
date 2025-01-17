<?php

namespace Database\Seeders;

use App\Models\Contributor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contributor::factory()->count(500)->create();
    }
}
