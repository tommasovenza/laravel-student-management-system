<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // seed database
        for ($i = 1; $i < 11; $i++) {
            // create string
            $stringClass = "Class {$i}";
            // saving
            $class = new Classes();
            $class->name = $stringClass;
            $class->save();
        }
    }
}
