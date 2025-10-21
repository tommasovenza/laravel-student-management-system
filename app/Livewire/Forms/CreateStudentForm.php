<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Validate;
use App\Models\Section;
use App\Models\Student;

class CreateStudentForm extends Form
{
    // validate name
    #[Validate('required|min:3')]
    public $name;

    // validate email
    #[Validate('required|email|unique:students,email')]
    public $email;

    // validate section id
    #[Validate('required')]
    public $section_id;

    // iterable variable
    public $sections = [];

    // setSections
    public function setSections($class_id)
    {   
        // this sections is updated by this query
        $this->sections = Section::where('class_id', $class_id)->get();
    }

    // store a new student
    public function storeStudent($class_id)
    {
        // create a resource student
        Student::create([
            'name' => $this->name,
            'email' => $this->email,
            'class_id' => $class_id,
            'section_id' => $this->section_id,
        ]);
    }
}
