<?php

namespace App\Http\Livewire;

use App\Models\Holiday;
use Livewire\Component;
use Livewire\WithPagination;

class SearchHolidays extends Component
{
    use WithPagination;

    public function render()
    {
        $holidays = Holiday::orderByDesc('ending_date')->paginate(20);
        return view('livewire.search-holidays', compact('holidays'));
    }
}
