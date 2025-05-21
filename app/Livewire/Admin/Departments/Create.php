<?php

namespace App\Livewire\Admin\Departments;

use App\Livewire\Forms\Admin\Departments\DepartmentForm;
use Livewire\Component;

class Create extends Component
{
    public DepartmentForm $form;


    public function mount()
    {
        $this->form->setCompanyId(session('company_id') ?? null);
    }

    public function save()
    {
        $this->form->store();

        $this->reset();

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');

    }
    public function render()
    {
        return view('livewire.admin.departments.create');
    }
}
