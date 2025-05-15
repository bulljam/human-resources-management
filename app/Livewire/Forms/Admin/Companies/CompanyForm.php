<?php

namespace App\Livewire\Forms\Admin\Companies;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;

class CompanyForm extends Form
{
    public ?Company $company;

    public $name = '';
    public $email = '';
    public $website = '';
    public $logo = null;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:companies,email,' . ($this->company?->id ?? 'NULL'),
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function setCompany(Company $company)
    {
        $this->company = $company;

        $this->name = $company->name;
        $this->email = $company->email;
        $this->website = $company->website;
    }

    public function store()
    {
        $this->validate();

        $data = $this->except(['logo', 'company']);

        if ($this->logo) {
            $data['logo'] = $this->logo->store('logos', 'public');
        }

        Company::create($data);
    }

    public function update()
    {
        $this->validate();

        $data = $this->except(['logo', 'company']);

        if ($this->logo) {
            if ($this->company->logo) {
                Storage::disk('public')->delete($this->company->logo);
            }
            $data['logo'] = $this->logo->store('logos', 'public');
        }

        $this->company->update($data);
    }
}
