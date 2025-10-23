<?php

namespace App\Livewire;

use App\Models\Classes;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Livewire\Forms\CreateStudentForm;

class CreateStudent extends Component
{
    // set variables
    public CreateStudentForm $form;
    
    #[Validate('required')]
    public $class_id;

    // update method that is hooked by wire:model.live on select's form element
    public function updatedClassId($class_id)
    {
        // update sections passing $class_id that is bind
        $this->form->setSections($class_id);
    }

    // method called by form to save student
    public function save()
    {
        // livewire validation
        $this->validate();

        // call method to store a student
        $this->form->storeStudent($this->class_id);

        // redirect
        return redirect()->route('student.index');
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
