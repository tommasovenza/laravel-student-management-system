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
    // importing UpdateStudent Form
    public UpdateStudentForm $form;

    // Student Model
    public Student $student;

    // class id
    #[Validate('required')]
    public $class_id;

    // call mount method
    public function mount(Student $student)
    {
        $this->form->name = $student->name;
        $this->form->email = $student->email;
        $this->class_id = $student->class_id;
        $this->form->sections = Section::where('class_id', $this->class_id)->get();
    }

    public function editStudent()
    {
        // validation
        $this->validate([
            'form.email' => 'required|unique:students,email,' . $this->student->id
        ]);

        // calling form function updateStudent passing class_id and current student
        $this->form->updateStudent($this->class_id, $this->student);

        // redirect
        return redirect()->route('students.index');
    }

    // render component
    public function render()
    {
        return view('livewire.edit-student', [
            'classes' => Classes::all()
        ]);
    }
}
