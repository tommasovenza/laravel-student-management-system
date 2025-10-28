<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ListStudent extends Component
{
    // search functionality to implement
    public string $search = '';

    // render method
    public function render()
    {
        $students = Student::query();

        $students = $students->where(function (Builder $query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        })
            ->paginate();

        return view('livewire.list-student', [
            // passing data to view
            'students' => $students
        ]);
    }

    public function deleteStudent($id)
    {
        $student = Student::find($id);

        $student->delete();

        return redirect()->route('students.index');
    }
}
