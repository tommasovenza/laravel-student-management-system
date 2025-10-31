<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ListStudent extends Component
{
    // laravel pagination
    use WithPagination;

    // Defining component State
    // search
    public string $search = '';

    public string $columnToSort = 'id';

    public string $sortDirection = 'desc';

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

    // this function just apply sort and takes in a Query Builder Object
    protected function applySort(Builder $query): Builder
    {
        return $query = $query->orderBy($this->columnToSort, $this->sortDirection);
    }

    // function to sort
    public function sortBy($columnClicked)
    {
        if ($columnClicked === $this->columnToSort) {
            $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        } else {
            // changing direction to sort
            $this->sortDirection = 'asc';
            // resetting column clicked
            $this->columnToSort = $columnClicked;
        }
    }

    // render method
    public function render()
    {
        // instantiate a query object to make complicated queries later on...
        $queryStudentsObj = Student::query();

        // these are filtered students
        $students = $this->applySearch($queryStudentsObj);

        // sorted by function applySort
        $students = $this->applySort($students);

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
