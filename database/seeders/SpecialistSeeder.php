<?php

namespace Database\Seeders;

use App\Models\Specialist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialists = [
            'Neurologist',
            'Gynecologist',
            'Allergist',
            'Oncologist',
            'Cardiologists',
            'Psychiatrists'
        ];

        foreach($specialists as $specialist){
            Specialist::create([
                'name' => $specialist
            ]);
        }
        
    }
}
