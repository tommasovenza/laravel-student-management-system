<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ["Section A", "Section B"];
        for ($i = 1; $i < 11; $i++) {
            foreach ($data as $key => $value) {
                // instance a new section
                $section = new Section();
                $section->class_id = $i;
                $section->name = $value;
                $section->save();
            }
        }
    }
}
