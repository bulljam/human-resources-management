<?php

namespace App\Livewire\Admin\Departments;

use App\Livewire\Forms\Admin\Departments\DepartmentForm;
use App\Models\Department;
use Livewire\Component;

class Edit extends Component
{
    public DepartmentForm $form;

    public function mount(Department $department)
    {
        $this->form->setCompanyId(session('company_id')?? null);
        $this->form->setDepartment($department);
    }

    public function save()
    {
        $this->form->update();

        return redirect()->route('admin.departments.index')->with('success', 'Department updated successfully.');
    }
    public function render()
    {
        return view('livewire.admin.departments.edit');
    }
}
