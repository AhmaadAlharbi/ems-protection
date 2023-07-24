<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Holiday;
use Livewire\Component;
use Livewire\WithPagination;

class SearchHolidays extends Component
{
    use WithPagination;
    public $showEndToday = false;

    public function render()
    {
        $currentDay = Carbon::today()->toDateString();
        $holidays = Holiday::orderByDesc('ending_date')->paginate(20);
        $holidays_end_today = Holiday::whereDate('ending_date', $currentDay)->get();
        return view('livewire.search-holidays', compact('holidays', 'holidays_end_today'));
    }
    public function showEndToday()
    {
        $this->showEndToday = !$this->showEndToday;
    }
}
