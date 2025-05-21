<?php

namespace App\Livewire\Admin\Companies;

use App\Livewire\Forms\Admin\Companies\CompanyForm;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public CompanyForm $form;

    public function mount(Company $company)
    {
        $this->form->setCompany($company);
    }

    public function save()
    {
        $this->form->update();

        $this->reset();

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }
    public function render()
    {
        return view('livewire.admin.companies.edit');
    }
}
