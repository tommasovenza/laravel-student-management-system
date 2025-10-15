<?php

namespace App\Livewire;

use App\Models\Classes;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CreateStudent extends Component
{
    // set variables
    #[Validate('required|min:3')]
    public $name;
    #[Validate('required|email|min:3')]
    public $email;
    #[Validate('required')]
    public $class_id;
    #[Validate('required')]
    public $section_id;

    // saving
    public function save()
    {
        $this->validate();
        dd("test");
    }

    // Created component
    public function render()
    {
        // passing classes' data to view
        return view('livewire.create-student', [
            'classes' => Classes::all()
        ]);
    }
}
