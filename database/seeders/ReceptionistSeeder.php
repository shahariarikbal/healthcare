<?php

namespace Database\Seeders;

use App\Models\Receptionist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Receptionist::create([
            'first_name' => 'Abdullah',
            'last_name' => 'Abdullah',
            'email' => 'abdullah@info.com',
            'password' => bcrypt('12345678'),
            'phone' => '+8801309608232',
            'gender' => 'Male',
            'qualification' => 'IR',
            'experience' => '2',
            'avatar' => url('/assets/images/avatar.png')
        ]);
    }
}
