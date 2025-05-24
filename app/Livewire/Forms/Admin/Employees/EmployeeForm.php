<?php

namespace App\Livewire\Forms\Admin\Employees;

use App\Models\Employee;
use Livewire\Form;

class EmployeeForm extends Form
{
    public ?Employee $employee;
    public $name = '';
    public $email = '';

    public $phone = '';

    public $address = '';

    public $designation_id = '';

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email,' . ($this->employee ?? 'NULL'),
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'designation_id' => 'required|integer|exists:designations,id',
        ];
    }

    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function store()
    {
        $this->validate();

        Employee::create($this->except(['employee']));
    }

    public function update()
    {
        $this->validate();

        $this->employee->update($this->except(['employee']));
    }

}
