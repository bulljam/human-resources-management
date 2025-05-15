<?php

namespace App\Livewire\Admin\Companies;

use App\Livewire\Forms\Admin\Companies\CompanyForm;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public CompanyForm $form;


    public function save()
    {
        $this->form->store();

        $this->reset();

        return redirect()->route('admin.companies.index')->with('success', 'Company created successfully.');
    }
    public function render()
    {
        return view('livewire.admin.companies.create');
    }
}
