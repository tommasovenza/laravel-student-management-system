<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // first cycle
        for ($i = 1; $i <= 5; $i++) {
            // second cycle
            for ($j = 1; $j <= 10; $j++) {
                $faker = Factory::create();
                $student = new Student();
                $student->class_id = $j;
                $student->section_id = $i;
                $student->name = $faker->name();
                $student->email = $faker->email();
                $student->save();
            }
        }
    }
}
