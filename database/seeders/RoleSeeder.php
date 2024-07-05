<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public $roles = [
        [
            'name' => 'Admin',
            'code' => 'AD'
        ],
        [
            'name' => 'Anggota',
            'code' => 'AG'
        ]
    ];
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->roles as $role) {
            Role::create([
                'name' => $role['name'],
                'code' => $role['code']
            ]);
        }
    }
}
