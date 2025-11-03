<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ListStudent extends Component
{
    // laravel pagination
    use WithPagination;

    // Defining component State
    // search
    public string $search = '';
    // default Column to Sort
    public string $columnToSort = 'id';
    // default Sort Direction
    public string $sortDirection = 'desc';

    // empty array to do some actions with livewire and alpine at checkbox click
    public array $selectedStudentIds = [];


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

    public function deleteAll()
    {
        // foreach on all selected students
        foreach ($this->selectedStudentIds as $id) {
            // find resource to delete
            $studentToDelete = Student::find($id);
            // deleting
            $studentToDelete->delete();
        }

        // send a notification to user through Filament
        Notification::make()
            ->title('Students Deleted successfully!')
            ->success()
            ->send();

        // return
        return redirect()->route('students.index');
    }

    protected function queryString()
    {
        return [
            'columnToSort',
            'sortDirection'
        ];
    }

    public function exportExcel()
    {
        return Excel::download(new StudentExport($this->selectedStudentIds),  now() . '_student.xlsx');
    }
}
