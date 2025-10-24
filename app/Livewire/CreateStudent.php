<?php

namespace App\Livewire;

use App\Models\Classes;
use App\Models\Section;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Livewire\Forms\CreateStudentForm;

class CreateStudent extends Component
{     
    // import Create Student Form
    public CreateStudentForm $form;

    #[Validate('required')]
    public $class_id;

    // update this sections
    public function updatedClassId($value_class_id)
    {   
        $this->form->sections = Section::where('class_id', $value_class_id)->get();
    }

    // call form object to store a new student
    public function store()
    {
       $this->form->setStudentForStoring($this->class_id);
    }

    // render component and classes data
    public function render()
    {
        return view('livewire.create-student', [
            'classes' => Classes::all()
        ]);
    }
}
