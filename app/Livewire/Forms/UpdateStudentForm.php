<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Section;
use App\Models\Student;
use Livewire\Attributes\Validate;

class UpdateStudentForm extends Form
{
    // Variables
    // Student Model
    public ?Student $student = null;
    // Name and validate name
    #[Validate('required|min:3')]
    public $name;
    // Email
    public $email;
    // section id
    #[Validate('required')]
    public $section_id;
    // iterable variable
    public $sections = [];

    // setSections
    public function setSections($value_class_id)
    {   
        // this sections is updated by this query
        $this->sections = Section::where('class_id', $value_class_id)->get();
    }

    public function mount(Student $student)
    {
        $this->student = $student;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->section_id = $student->section_id;
    }

    // update a new student
    public function updateStudent($class_id)
    {   
        // livewire validation
        $this->validate([
            "email" => 'required|email|unique:students,email,' . $this->student->id
        ]);
        
        // create a resource student
        $this->student->update([
            'name' => $this->name,
            'email' => $this->email,
            'class_id' => $class_id,
            'section_id' => $this->section_id,
        ]);
    }
}
