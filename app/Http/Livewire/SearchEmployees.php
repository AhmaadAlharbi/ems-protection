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

    public function render()
    {
        $takleefs = Takleef::whereHas('employee', function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->orderByDesc('id')->paginate(5);

        $takleefs = Takleef::whereHas('employee', function ($query) {
            $query->where('fileNo', 'like', '%' . $this->search . '%');
        })->orderByDesc('id')->paginate(5);

        return view('livewire.search-employees', [
            'takleefs' => $takleefs,
        ]);
    }
}
