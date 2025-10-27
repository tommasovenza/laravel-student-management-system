<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Section;
use Faker\Factory;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        // for each class (1..10)
        for ($classId = 1; $classId <= 10; $classId++) {

            // get sections belongs to this class
            $sectionsForClass = Section::where('class_id', $classId)->pluck('id')->all();
            // example: [5, 6]

            // security: if for some reason there are no sections, skip
            if (empty($sectionsForClass)) {
                continue;
            }

            // create 5 students foreach class
            for ($i = 0; $i < 5; $i++) {

                // take a section that is valid for that class
                $sectionId = $faker->randomElement($sectionsForClass);
                // create
                $student = new Student();
                $student->class_id = $classId;
                $student->section_id = $sectionId;
                $student->name = $faker->name();
                $student->email = $faker->unique()->safeEmail();
                $student->save();
            }
        }
    }
}
