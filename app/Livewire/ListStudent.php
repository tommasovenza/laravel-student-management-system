<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;

class ListStudent extends Component
{
    // render method
    public function render()
    {
        return view('livewire.list-student', [
            // passing data to view
            'students' => Student::paginate()
        ]);
    }

    public function deleteStudent($id)
    {
        $student = Student::find($id);

        $student->delete();

        return redirect()->route('students.index');
    }
}
