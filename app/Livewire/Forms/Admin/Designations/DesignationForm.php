<?php

namespace App\Livewire\Forms\Admin\Designations;

use App\Models\Designation;
use Livewire\Form;

class DesignationForm extends Form
{
    public ?Designation $designation;
    public $name = '';
    public $department_id = '';

    public ?int $company_id;


    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'department_id' => 'required|integer|exists:departments,id',
        ];
    }

    public function setDesignation(Designation $designation)
    {
        $this->designation = $designation;

        $this->name = $designation->name;

        $this->department_id = $designation->department_id;
    }

    public function store()
    {
        $this->validate();

        Designation::create([
            'name' => $this->name,
            'department_id' => $this->department_id,
        ]);
    }

    public function update()
    {
        $this->validate();

        $this->designation->update([
            'name' => $this->name,
            'department_id' => $this->department_id,
        ]);
    }
}
