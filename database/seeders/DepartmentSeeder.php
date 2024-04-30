<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'Neurologist',
            'Gynecologist',
            'Allergist',
            'Oncologist',
            'Cardiologists',
            'Psychiatrists'
        ];

        foreach($departments as $department){
            Department::create([
                'name' => $department,
                'slug' => Str::slug($department)
            ]);
        }
        
    }
}
