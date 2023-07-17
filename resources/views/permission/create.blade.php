<x-app-layout>
    <x-slot name="header " class="">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('permission.store')}}" method="POST">
                        @csrf
                        <div class="flex flex-col gap-4">
                            <label for="fileNo" class="text-sm font-medium">File No | رقم الملف</label>
                            <input type="text" name="fileNo"
                                class="w-full bg-gray-50 border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500">
                            <label for="date" class="text-sm font-medium">Date | التاريخ</label>
                            <input name="date" type="date" min="{{ date('Y-m-01') }}" max="{{ date('Y-m-t') }}"
                                class="w-full bg-gray-50 border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500">
                            <label for="time" class="text-sm font-medium">Time : الوقت</label>
                            <input type="time" name="time"
                                class="w-full bg-gray-50 border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500">
                            <div>
                                <label for="reason">reason | السبب</label>
                                <input type="text" name="reason"
                                    class="w-full bg-gray-50 border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="flex items-center gap-2">
                                <label class="mr-2">
                                    <input type="radio" name="status" value="in" class="rounded-md text-gray-600">
                                    <span class="text-sm">In | دخول</span>
                                </label>
                                <label>
                                    <input type="radio" name="status" value="out" class="rounded-md text-gray-600">
                                    <span class="text-sm">Out | خروج</span>
                                </label>

                            </div>

                            <button type="submit"
                                class="w-full bg-cyan-500 text-white font-bold py-2 px-4 rounded-md">submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>