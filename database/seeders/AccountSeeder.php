<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::create([
            'first_name' => 'Abdur',
            'last_name' => 'Razzak',
            'email' => 'razzak@info.com',
            'password' => bcrypt('12345678'),
            'phone' => '+8801309608232',
            'gender' => 'Male',
            'qualification' => 'BBA, MBA, CA',
            'experience' => '2.5',
            'avatar' => url('/assets/images/avatar.png')
        ]);
    }
}
