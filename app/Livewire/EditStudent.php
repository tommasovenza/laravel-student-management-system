<?php

namespace App\Livewire;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Livewire\Forms\UpdateStudentForm;

class EditStudent extends Component
{
    public UpdateStudentForm $form;
    public Student $student;

    #[Validate('required')]
    public $class_id;

    // this function hook takes in by route model binding the Student
    // we can use this student to fill the form fields when page is uploaded
    // public function mount(Student $student)
    // {   
    //     $this->form->name = $student->name;
    //     $this->form->email = $student->email;
    //     $this->class_id = $student->class_id;
    //     $this->form->sections = Section::where('class_id', $student->class_id)->get();
    // }

    public function mount(Student $student)
    {
        $this->student = $student;

        // Inizializza il form
        // $this->form = new UpdateStudentForm();
        $this->form->mount($student);

        $this->class_id = $student->class_id;
        $this->form->sections = Section::where('class_id', $student->class_id)->get();
    }


    // update method that is hooked by wire:model.live on select's form element
    public function updatedClassId($class_id)
    {
        // update sections passing $class_id that is bind
        $this->form->setSections($class_id);
    }

    // Editing Student
    public function edit()
    {
        // updating
        $this->form->updateStudent($this->class_id);

        // redirect using correct syntax for SPA Experience
        $this->redirect('students.index', navigate:true);
    }

    public function render()
    {
        // return view with data
        return view('livewire.edit-student', [
            'classes' => Classes::all()
        ]);
    }
}
