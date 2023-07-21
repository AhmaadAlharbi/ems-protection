<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;

class SearchPermission extends Component
{
    use WithPagination;
    public $search;
    public $selectedMonth = null;
    protected $listeners = ['updatedSearch', 'deletePermission'];
    public function render()
    {
        $currentYear = Carbon::now()->year;
        if ($this->selectedMonth === null) {
            $this->selectedMonth = Carbon::now()->month;
        }

        $permissions = Permission::whereYear('date', $currentYear)
            ->when($this->selectedMonth, function ($query) {
                return $query->whereMonth('date', $this->selectedMonth);
            })
            ->whereHas('employee', function ($query) {
                $query->where('fileNo', 'like',  $this->search . '%');
            })
            ->orderByDesc('created_at')
            ->orderBy('date')
            ->paginate(10);

        return view('livewire.search-permission', compact('permissions'));
    }
    public function confirmDelete($permission_id)
    {
        // dd($permission_id);
        $this->dispatchBrowserEvent('showDeleteConfirmation', ['permission_id' => $permission_id]);
    }

    public function deletePermission($permission_id)
    {
        $perm = Permission::findOrFail($permission_id);
        $perm->delete();
        session()->flash('success', 'Employee deleted successfully.');
    }
}
