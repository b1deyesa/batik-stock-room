<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RoleSeeder::class
        ]);
        
        User::factory()->create([
            'role_id' => 1,
            'code' => 'AD001',
            'first_name' => 'Imagodeo',
            'last_name' => 'Bideyesa',
            'email' => 'bideyesa@gmail.com',
            'password' => Hash::make('magox1905')
        ]);
    }
}
