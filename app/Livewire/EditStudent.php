<?php

namespace App\Livewire;

use App\Models\Classes;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Validate;

class EditStudent extends Component
{
    // set variables
    #[Validate('required|min:3')]
    public $name;
    // #[Validate('required|email|unique:students,email')]
    public $email;
    #[Validate('required')]
    public $class_id;
    #[Validate('required')]
    public $section_id;

    // iterable variable
    public $sections = [];

    public $dataStudent;

    // this function hook takes in by route model binding the Student and makes dd()
    // we can use this student to fill the form fields
    public function mount(Student $student)
    {
        // dd($student);
        $this->dataStudent = $student;
    }

    // saving
    public function editStudent()
    {
        // livewire validation
        $this->validate([
            "email" => 'required|email|unique:students,email'
        ]);

        dd("everything ok");

        // saving
        // Student::create([
        //     'name' => $this->name,
        //     'email' => $this->email,
        //     'class_id' => $this->class_id,
        //     'section_id' => $this->section_id,
        // ]);

        // $this->redirect('/students/index');
    }

    // update method that is hooked by wire:model.live on select's form element
    // public function updatedClassId($value)
    // {
    //     // this sections is updated by this query
    //     $this->sections = Section::where('class_id', $value)->get();
    // }
    public function render()
    {
        // return view with data
        return view('livewire.edit-student', [
            'dataStudent' => $this->dataStudent,
            'classes' => Classes::all()
        ]);
    }
}
