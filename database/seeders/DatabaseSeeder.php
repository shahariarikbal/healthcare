<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin seeder
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'avatar' => url('/assets/images/avatar.png'),
            'logo' => url('/assets/images/logo.png')
        ]);

        // Other users seeder
        $this->call([
            DoctorSeeder::class,
            AccountSeeder::class,
            ReceptionistSeeder::class,
            DepartmentSeeder::class,
            PatientSeeder::class,
            AppointmentSeeder::class
        ]);
    }
}
