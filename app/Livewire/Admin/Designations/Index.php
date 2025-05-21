<?php

namespace App\Livewire\Admin\Designations;

use App\Models\Designation;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;


    public function delete(Designation $designation)
    {
        $designation->delete();
        session()->flash('success', 'Designation deleted successfully');
    }
    public function render()
    {
        return view(
            'livewire.admin.designations.index',
            [
                'designations' => Designation::inCompany()->paginate(5),
            ]
        );
    }
}
