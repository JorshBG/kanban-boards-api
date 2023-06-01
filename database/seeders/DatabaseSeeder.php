<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Activity;
use App\Models\Role;
use App\Models\User;
use App\Models\Board;
use App\Models\UserHasBoards;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin']);
            // Default user as user role
        User::create([
            'name' => 'Jordi',
            'last_name' => 'Calva',
            'cellphone' => '7721446962',
            'email' => 'jordiyair29@gmail.com',
            'password' => 'password',
            'role_id' => 10000,
        ]);
        User::create([
            'name' => 'Yair',
            'last_name' => 'Garcia',
            'cellphone' => '7731441962',
            'email' => 'ayir@gmail.com',
            'password' => 'password',
            'role_id' => 10001,
        ]);

        // Create 10 user in the database with its factory
        // User::factory(2)->create();

        // Create 10 boards
        Board::factory(5)->create();

        // Create relation between users and boards, 5 relations
        UserHasBoards::factory(10)->create();

        // Create activities for the boards
        Activity::factory(30)->create();


        User::factory(10)->create();

        // Create roles for the web app: "user" and "admin"

    }
}
