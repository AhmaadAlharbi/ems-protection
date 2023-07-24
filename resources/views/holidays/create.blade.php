<x-app-layout>
    <x-slot name="header " class="">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('success'))
            <script>
                Swal.fire('Success', '{{ session('success') }}', 'success');
            </script>
            @endif
            @if ($errors->any())

            <div class="p-4 text-white bg-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="my-1">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('holidays.store') }}" method="POST" class="max-w-sm mx-auto">
                        @csrf
                        <div class="mb-4">
                            <label for="fileNo" class="block text-gray-700 font-semibold mb-1">File.No</label>
                            <input type="text" name="fileNo" value="{{ old('fileNo') }}"
                                class="w-full px-4 py-2 rounded border-gray-300 focus:ring focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <div class="mb-4">
                                <label for="starting_date" class="block text-gray-700 font-semibold mb-1">Start
                                    Date</label>
                                <input type="date" name="starting_date" id="starting_date"
                                    value="{{ old('starting_date') }}"
                                    class="w-full px-4 py-2 rounded border-gray-300 focus:ring focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="mb-4">
                                <label for="counting_days" class="block text-gray-700 font-semibold mb-1">Days
                                    Count</label>
                                <input type="number" name="days_count" id="days_count" value="{{ old('days_count') }}"
                                    class="w-full px-4 py-2 rounded border-gray-300 focus:ring focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="mb-4">
                                <label for="ending_date" class="block text-gray-700 font-semibold mb-1">End Date</label>
                                <input type="date" name="ending_date" id="ending_date" value="{{ old('ending_date') }}"
                                    class="w-full px-4 py-2 rounded border-gray-300">
                            </div>
                        </div>
                        <button type="submit"
                            class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                            Submit
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get references to the input elements
        const startingDateInput = document.getElementById('starting_date');
        const daysCountInput = document.getElementById('days_count');
        const endingDateInput = document.getElementById('ending_date');

        // Add event listeners to the starting date and days count inputs
        startingDateInput.addEventListener('change', function () {
            calculateEndDate();
            calculateDaysCount();
        });

        daysCountInput.addEventListener('input', function () {
            calculateEndDate();
        });

        // Add event listener to the ending date input
        endingDateInput.addEventListener('change', function () {
            calculateDaysCount();
        });

        // Function to calculate the ending date based on starting date and days count
        function calculateEndDate() {
            const startingDate = new Date(startingDateInput.value);
            const daysCount = parseInt(daysCountInput.value);

            if (!isNaN(startingDate.getTime()) && !isNaN(daysCount)) {
                const endingDate = new Date(startingDate);
                endingDate.setDate(startingDate.getDate() + daysCount);

                if (!isNaN(endingDate.getTime())) {
                    const year = endingDate.getFullYear();
                    const month = String(endingDate.getMonth() + 1).padStart(2, '0');
                    const day = String(endingDate.getDate()).padStart(2, '0');

                    endingDateInput.value = `${year}-${month}-${day}`;
                } else {
                    endingDateInput.value = '';
                }
            } else {
                endingDateInput.value = '';
            }
        }

        // Function to calculate the number of days between starting date and ending date
        function calculateDaysCount() {
            const startingDate = new Date(startingDateInput.value);
            const endingDate = new Date(endingDateInput.value);

            if (!isNaN(startingDate.getTime()) && !isNaN(endingDate.getTime())) {
                const differenceInMilliseconds = endingDate - startingDate;
                const daysCount = Math.round(differenceInMilliseconds / (1000 * 60 * 60 * 24));

                if (!isNaN(daysCount)) {
                    daysCountInput.value = daysCount;
                } else {
                    daysCountInput.value = '';
                }
            } else {
                daysCountInput.value = '';
            }
        }
    });
</script>