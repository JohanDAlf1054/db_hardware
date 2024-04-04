<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        'name' => 'Brayan Pinilla',
        'email' => 'brayan@gmail.com',
        'phone_number' => '3213154321',
        'document_type' => 'CC',
        'identification_number' => '837231214',
        'password' => bcrypt('123456789'),
        ])->assignRole('Admin');

        User::factory(9)->create();
    }
}
