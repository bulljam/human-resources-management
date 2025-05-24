<?php

namespace App\Livewire\Admin\Employees;

use App\Livewire\Forms\Admin\Employees\EmployeeForm;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Livewire\Component;

class Edit extends Component
{
    public EmployeeForm $form;

    public $department_id;

    public function mount(Employee $employee)
    {
        $this->form->setEmployee($employee);
        $this->department_id = $this->form->employee->department->department_id;
    }

    public function save()
    {
        $this->form->update();

        return redirect()->route('employees.index')->with('success', 'Employee updated succcessfully.');
    }

    public function render()
    {
        $designations = Designation::inCompany()->where('department_id', $this->department_id)->get();

        $departments = Department::inCompany()->get();
        return view('livewire.admin.employees.edit', compact('designations', 'departments'));
    }
}
