<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Payment;
use App\Models\Project;
use App\Enums\UserRoleEnum;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contributor;
use App\Models\Institution;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(1)->create();
        //Institution::factory(1)->create();
        //Contributor::factory(1000)->create();
        //Payment::factory(1000)->create();
        $this->call([
            ProjectSeeder::class,
            UserSeeder::class,
            ContributorSeeder::class,
            PaymentSeeder::class,
        ]);


        $user = User::where('email', 'admin@arnson.com')->first();

        if ($user === null) {
            User::factory()->create([
                'name' => "Arnson Innovate",
                'email' => 'admin@arnson.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => null,
                'role' => UserRoleEnum::Admin,
                'password_changed_at' => now()
            ]);
        }
    }
}
