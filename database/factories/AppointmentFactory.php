<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Appointment::class;
    public function definition(): array
    {
        return [
            'patient_id' => Patient::all()->random()->id,
            'doctor_id' => Doctor::all()->random()->id,
            'appointment_date' => $this->faker->date('Y-m-d'),
            'problem' => $this->faker->paragraph,
            'status' => $this->faker->numberBetween(0, 4)
        ];
    }
}
