<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Takleef;
use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;

class SearchEmployees extends Component
{
    use WithPagination;

    public $search;

    protected $listeners = ['updatedSearch', 'deleteEmployee'];

    public function render()
    {
        $employees = Employee::where('fileNo', 'like', '%' . $this->search . '%')
            ->orderBy('fileNo')
            ->paginate(15);

        return view('livewire.search-employees', [
            'employees' => $employees,
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($employeeId)
    {
        // dd($employeeId);
        $this->dispatchBrowserEvent('showDeleteConfirmation', ['employeeId' => $employeeId]);
    }

    public function deleteEmployee($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $employee->delete();
        session()->flash('success', 'Employee deleted successfully.');
    }
}