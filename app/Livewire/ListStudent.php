<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ListStudent extends Component
{
    // full component layout as explained in livewire 3 documentation
    // #[Layout('layouts.app')]

    // render method
    public function render()
    {
        return view('livewire.list-student', [
            // passing data to view
            'students' => Student::paginate()
        ]);
    }
}
