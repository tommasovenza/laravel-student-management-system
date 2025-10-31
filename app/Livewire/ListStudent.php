<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ListStudent extends Component
{

    use WithPagination;

    // search
    public string $search = '';

    // this function using $search change state to make a query and 
    // filter on fronted on user keyboard on input's search
    public function applySearch(Builder $query): Builder
    {
        // make query
        return $query = $query->where(function (Builder $query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        });
    }

    // render method
    public function render()
    {
        // instantiate a query object to make complicated queries later on...
        $queryStudentsObj = Student::query();

        // these are filtered students
        $students = $this->applySearch($queryStudentsObj);

        // returning view
        return view('livewire.list-student', [
            // passing data to view
            'students' => $students->paginate(10)
        ]);
    }

    // delete student resource
    public function deleteStudent($id)
    {
        // get student from id
        $student = Student::find($id);
        // delete student resource
        $student->delete();
        // redirect
        return redirect()->route('students.index');
    }
}
