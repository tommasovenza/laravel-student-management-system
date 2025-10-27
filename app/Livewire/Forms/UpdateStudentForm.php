<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Student;
use Livewire\Attributes\Validate;

class UpdateStudentForm extends Form
{
    //
    public Student $student;

    #[Validate('required')]
    public $name;

    public $email;

    #[Validate('required')]
    public $section_id;

    public $sections = [];

    // store a new student
    public function updateStudent($class_id, $student)
    {
        // update a new student
        $student->update([
            'name' => $this->name,
            'email' => $this->email,
            'class_id' => $class_id,
            'section_id' => $this->section_id,
        ]);
    }
}
