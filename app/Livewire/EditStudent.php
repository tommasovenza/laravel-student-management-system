<?php

namespace App\Livewire;

use App\Models\Classes;
use App\Models\Student;
use App\Models\Section;
use Livewire\Component;
use Livewire\Attributes\Validate;

class EditStudent extends Component
{

    public Student $student;
    // set variables
    #[Validate('required|min:3')]
    public $name;
    // removed validation for email here and moved inside updated function
    public $email;
    #[Validate('required')]
    public $class_id;
    #[Validate('required')]
    public $section_id;

    // iterable variable
    public $sections = [];

    // this function hook takes in by route model binding the Student
    // we can use this student to fill the form fields when page is uploaded
    public function mount(Student $student)
    {
        $this->name = $student->name;
        $this->email = $student->email;
        $this->class_id = $student->class_id;
        $this->sections = Section::where('id', $student->section_id)->get();
    }

    // Editing Student
    public function editStudent()
    {
        // livewire validation
        $this->validate([
            "email" => 'required|email|unique:students,email,' . $this->student->id
        ]);

        // saving
        $this->student->update([
            'name' => $this->name,
            'email' => $this->email,
            'class_id' => $this->class_id,
            'section_id' => $this->section_id,
        ]);

        // redirect
        $this->redirect('/students/index');
    }

    // update method that is hooked by wire:model.live on select's form element
    public function updatedClassId($value)
    {
        // this sections is updated by this query
        $this->sections = Section::where('class_id', $value)->get();
    }

    public function render()
    {
        // return view with data
        return view('livewire.edit-student', [
            'classes' => Classes::all()
        ]);
    }
}
