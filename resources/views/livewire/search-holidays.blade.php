<div>
    <div class="flex items-center justify-center mt-10 space-x-12">

        <a href="{{route('holidays.create')}}"
            class="flex max-w-sm items-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
            Add new Holidays to employee
        </a>
        <button wire:click="showEndToday"
            class="flex max-w-sm items-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
            Holidays Ending Today | العطل المنتهية اليوم
        </button>
    </div>
    <div class="flex justify-evenly">
        @if($showEndToday)
        <table class="w-full border-collapse border border-slate-400 text-center border-spacing-2 table-auto mt-4">
            <thead>
                <tr>
                    <th class="border border-slate-300 py-5">id</th>
                    <th class="border border-slate-300 py-5">employee</th>
                    <th class="border border-slate-300 py-5">File No</th>
                    <th class="border border-slate-300 py-5">starting Date</th>
                    <th class="border border-slate-300 py-5">ending Date</th>
                    <th class="border border-slate-300 py-5">Days Count</th>
                    <th class="border border-slate-300 py-5">added by</th>
                </tr>
            </thead>
            <tbody>
                @foreach($holidays_end_today as $holiday)
                <tr class="holiday-row {{ $holiday->ending_date < now()->toDateString() ? 'expired' : '' }}">
                    <td class="border border-slate-300 py-3">{{$loop->iteration}}</td>
                    <td class="border border-slate-300 py-3">{{$holiday->employee->name}}</td>
                    <td class="border border-slate-300 py-3">{{$holiday->employee->fileNo}}</td>
                    <td class="border border-slate-300 py-3">{{$holiday->starting_date}}</td>
                    <td class="border border-slate-300 py-3">{{$holiday->ending_date}}</td>
                    <td class="border border-slate-300 ...">{{$holiday->days_count}}</td>
                    <td class="border border-slate-300 py-3">{{$holiday->user->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <table class="w-full mt-4 border-collapse border border-slate-400 text-center border-spacing-2 table-auto ">
            <thead>
                <tr>
                    <th class="border border-slate-300 py-5">id</th>
                    <th class="border border-slate-300 py-5">employee</th>
                    <th class="border border-slate-300 py-5">File No</th>
                    <th class="border border-slate-300 py-5">starting Date</th>
                    <th class="border border-slate-300 py-5">ending Date</th>
                    <th class="border border-slate-300 py-5">Days Count</th>
                    <th class="border border-slate-300 py-5">added by</th>
                    {{-- <th class="border border-slate-300 py-5">created at</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($holidays as $holiday)
                {{-- <tr class="{{ $holiday->ending_date  < now()->toDateString() ? 'bg-red-400 text-white' : '' }}">
                    --}}
                <tr class="holiday-row {{ $holiday->ending_date  < now()->toDateString() ? 'expired' : '' }}">

                    <td class="border border-slate-300 py-3">{{$loop->iteration}}</td>
                    <td class="border border-slate-300 py-3">{{$holiday->employee->name}}</td>
                    <td class="border border-slate-300 py-3">{{$holiday->employee->fileNo}}</td>
                    <td class="border border-slate-300 py-3">{{$holiday->starting_date}}</td>
                    <td class="border border-slate-300 py-3">{{$holiday->ending_date}}</td>
                    <td class="border border-slate-300 ...">{{$holiday->days_count}}</td>
                    <td class="border border-slate-300 py-3">{{$holiday->user->name}}</td>
                    {{-- <td class="border border-slate-300 py-3">{{$holiday->created_at->format('Y-m-d') }}</td> --}}
                </tr>
                @endforeach
            </tbody>
            {{ $holidays->links() }}

        </table>
        @endif

    </div>
</div>