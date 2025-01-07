<?php


namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Takleef;
use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;

class SearchTakleef extends Component
{
    use WithPagination;

    public $search;
    public $month;
    protected $listeners = ['updatedSearch'];

    public function render()
    {

        // $currentYear = Carbon::now()->year;
        $currentYear = Carbon::createFromDate(2024, 1, 1)->year;


        $takleefs = Takleef::whereMonth('date', $this->month)
            ->whereYear('date', $currentYear)
            ->where(function ($query) {
                $query->whereNotNull('employee_in')
                    ->orWhereNotNull('employee_out')
                    ->orWhereNotNull('in_confirmation');
            })
            ->whereHas('employee', function ($query) {
                $query->where('fileNo', 'like', '%' . $this->search . '%')
                    ->orWhere('name', 'like', '%' . $this->search . '%'); // Add username search
            })
            ->orderByDesc('created_at')
            ->orderBy('date')
            ->paginate(20);


        // $takleefs = Employee::whereHas('takleefList', function ($query) {
        //     $query->where('fileNo', 'like', '%' . $this->search . '%');
        // })->orderByDesc('id')->paginate(10);;

        return view('livewire.search-takleef', [
            'takleefs' => $takleefs,
        ]);
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
}
