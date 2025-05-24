<?php

namespace App\Livewire\Admin\Employees;

use App\Livewire\Forms\Admin\Employees\EmployeeForm;
use App\Models\Department;
use App\Models\Designation;
use Livewire\Component;

class Create extends Component
{

    public EmployeeForm $form;

    public $department_id;

    public function save()
    {
        $this->form->store();

        return redirect()->route('employees.index')->with('success', 'Employee created succcessfully.');
    }

    public function render()
    {
        $designations = Designation::inCompany()->where('department_id', $this->department_id)->get();

        $departments = Department::inCompany()->get();
        return view('livewire.admin.employees.create', compact('designations', 'departments'));
    }
}
