<div>
    <table class="w-full border-collapse border border-slate-400 text-center border-spacing-2 table-auto ">
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
            {{-- <tr class="{{ $holiday->ending_date  < now()->toDateString() ? 'bg-red-400 text-white' : '' }}"> --}}
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
</div>