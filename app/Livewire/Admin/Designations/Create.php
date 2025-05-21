<?php

namespace App\Livewire\Admin\Designations;

use App\Livewire\Forms\Admin\Designations\DesignationForm;
use Livewire\Component;

class Create extends Component
{
    public DesignationForm $form;


    public function save()
    {
        $this->form->store();

        $this->reset();

        return redirect()->route('designations.index')->with('success', 'Designation created successfully.');

    }

    public function render()
    {
        return view('livewire.admin.designations.create');
    }
}
