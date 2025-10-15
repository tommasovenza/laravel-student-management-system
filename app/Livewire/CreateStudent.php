<?php

namespace App\Livewire;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CreateStudent extends Component
{
    // set variables
    #[Validate('required|min:3')]
    public $name;
    #[Validate('required|email|unique:students,email')]
    public $email;
    #[Validate('required')]
    public $class_id;
    #[Validate('required')]
    public $section_id;

    // iterable variable
    public $sections = [];

    // saving
    public function save()
    {
        // livewire validation
        $this->validate();

        // saving
        Student::create([
            'name' => $this->name,
            'email' => $this->email,
            'class_id' => $this->class_id,
            'section_id' => $this->section_id,
        ]);

        $this->redirect('/students/index');
    }

    // update method that is hooked by wire:model.live on select's form element
    public function updatedClassId($value)
    {
        // this sections is updated by this query
        $this->sections = Section::where('class_id', $value)->get();
    }

    // Created component
    public function render()
    {
        // passing classes' data to view
        return view('livewire.create-student', [
            'classes' => Classes::all()
        ]);
    }
}
