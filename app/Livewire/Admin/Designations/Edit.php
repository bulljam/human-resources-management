<?php

namespace App\Livewire\Admin\Designations;

use App\Livewire\Forms\Admin\Designations\DesignationForm;
use App\Models\Designation;
use Livewire\Component;

class Edit extends Component
{
    public DesignationForm $form;

    public function mount(Designation $designation)
    {
        $this->form->setDesignation($designation);
    }

    public function save()
    {
        $this->form->update();

        return redirect()->route('designations.index')->with('success', 'Designation updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.designations.edit');
    }
}
