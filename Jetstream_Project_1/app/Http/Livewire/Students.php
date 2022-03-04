<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;

class Students extends Component
{
    public $isOpenModal;

    public function render()
    {
        $this->items = Student::all();
        return view('livewire.students');
    }

    public function create() {
        // $this->resetCreateForm();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpenModal = true;
    }

    public function closeModal()
    {
        $this->isOpenModal = false;
    }

    public function resetCreateForm()
    {
        $this->isOpenModal = true;
    }

    
}
