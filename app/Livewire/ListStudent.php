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

    // delete student resource
    // public function deleteStudent($id) 
    // {   
    //     // find student to delete
    //     Student::find($id)->delete();

    //     // we need this syntax to make a correct redirect as a SPA Application
    //     // return $this->redirect('students.index', navigate: true);
    //     return redirect()->route('students.index');
    // }
}
