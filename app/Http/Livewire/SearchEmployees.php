<?php

namespace App\Http\Livewire;

use App\Models\Takleef;
use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;

class SearchEmployees extends Component
{
    use WithPagination;

    public $search;
    protected $listeners = ['updatedSearch'];

    public function render()
    {


        $takleefs = Takleef::where(function ($query) {
            $query->whereNotNull('employee_in')
                ->orWhereNotNull('employee_out');
        })
            ->whereHas('employee', function ($query) {
                $query->where('fileNo', 'like', '%' . $this->search . '%');
            })
            ->orderByDesc('created_at')
            ->orderBy('date')

            ->paginate(10);

        // $takleefs = Employee::whereHas('takleefList', function ($query) {
        //     $query->where('fileNo', 'like', '%' . $this->search . '%');
        // })->orderByDesc('id')->paginate(10);;

        return view('livewire.search-employees', [
            'takleefs' => $takleefs,
        ]);
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
}
