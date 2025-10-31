<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ListStudent extends Component
{

    use WithPagination;

    // search
    public string $search = '';

    public $column = 'id';

    public $direction = 'desc';

    // with this function I was changing only the state of the properties
    // with click handled by livewire on the blade list-student file
    public function sort($columnToSort)
    {
        if ($this->column === $columnToSort) {
            // set this direction
            $this->direction = $this->direction === 'desc' ? 'asc' : 'desc';
        } else {
            // change column
            $this->column = $columnToSort;
            $this->direction = $this->direction === 'desc' ? 'asc' : 'desc';
        }
        // log
        logger("column passed: {$columnToSort}");
        logger("column var: {$this->column}");
        logger("direction: {$this->direction}");
        // 
        $this->resetPage();
    }

    // render method
    public function render()
    {
        // create a query builder instance
        $students = Student::query();

        // using it to filter if wire:model search is changing
        $students = $students->where(function (Builder $query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        });

        // this is just a laravel function to make a query and sort
        $students->orderBy($this->column, $this->direction);

        // returning view
        return view('livewire.list-student', [
            // passing data to view
            'students' => $students->paginate(10)
        ]);
    }

    public function deleteStudent($id)
    {
        $student = Student::find($id);

        $student->delete();

        return redirect()->route('students.index');
    }
}
