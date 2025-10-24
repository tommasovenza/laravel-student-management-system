<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Section;
use App\Models\Student;
use Livewire\Attributes\Validate;

class CreateStudentForm extends Form
{
    // Form Object =>>> // Here goes data and its validation
    #[Validate('required')]
    public $name;

    #[Validate('required|email|unique:students,email')]
    public $email;

    #[Validate('required')]
    public $sections = [];

    #[Validate('required')]
    public $section_id;

    // store a new student
    public function setStudentForStoring($class_id)
    {   
        // validation
        $this->validate();

        // create a new student
        Student::create([   
            'name' => $this->name,
            'email' => $this->email,
            'class_id' => $class_id,
            'section_id' => $this->section_id,
        ]);

        // redirect
        return redirect()->route('students.index');
    }
}
