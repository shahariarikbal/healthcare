<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Specialist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doctor::create([
            'department_id' => Department::first()->id ?? 1,
            'first_name' => 'Abdur',
            'last_name' => 'Rahman',
            'slug' => 'abdur-rahman',
            'email' => 'rahman@info.com',
            'password' => bcrypt('12345678'),
            'phone' => '+8801309608232',
            'gender' => 'Male',
            'fee' => '500',
            'qualification' => 'FCPS, MBBS, FRCS',
            'experience' => '2.5',
            'address' => 'Mirpur Pallabi, Dhaka Bangladesh',
            'about' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quis, sequi, ut veritatis sunt dolorum blanditiis omnis delectus at excepturi dolore, similique voluptatum ratione. Deleniti tempore, reiciendis dicta molestias facilis officiis.',
            'avatar' => url('/assets/images/avatar.png')
        ]);
    }
}
