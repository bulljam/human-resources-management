<?php

namespace App\Livewire\Forms\Admin\Departments;

use App\Models\Department;
use Livewire\Form;


class DepartmentForm extends Form
{
    public ?Department $department;
    public $name = '';

    public ?int $company_id;


    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    public function setDepartment(Department $department)
    {
        $this->department = $department;

        $this->name = $department->name;
    }

    public function setCompanyId($id)
    {
        $this->company_id = $id;
    }

    public function store()
    {
        $this->validate();

        if (!$this->company_id) {
            abort(403, 'No active company selected');
        }

        Department::create([
            'name' => $this->name,
            'company_id' => $this->company_id,
        ]);
    }

    public function update()
    {
        $this->validate();
        if ($this->company_id !== $this->department->company_id) {
            abort(403, 'No active company selected');
        }
        $this->department->update([
            'name' => $this->name,
        ]);
    }
}
