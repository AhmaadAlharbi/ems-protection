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
                    <form action="{{route('permission.update',$permission->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="flex flex-col gap-4">
                            <label for="fileNo" class="text-sm font-medium">File No | رقم الملف</label>
                            <input type="text" name="fileNo" id="fileNo" value="{{ $permission->employee->fileNo }}"
                                class="w-full bg-gray-50 border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500">
                            @if ($errors->has('fileNo'))
                            <span class="text-red-500 text-sm">{{ $errors->first('fileNo') }}</span>
                            @endif
                            <label for="date" class="text-sm font-medium">Date | التاريخ</label>
                            <input name="date" type="date" min="{{ date('Y-m-01') }}" max="{{ date('Y-m-t') }}"
                                value="{{ $permission->date }}"
                                class="w-full bg-gray-50 border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500">


                            @if ($errors->has('date'))
                            <span class="text-red-500 text-sm">{{ $errors->first('date') }}</span>
                            @endif
                            <label for="time" class="text-sm font-medium">Time : الوقت</label>

                            <input type="time" name="time"
                                class="w-full bg-gray-50 border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500"
                                value="{{ $permission->time }}">

                            @if ($errors->has('time'))
                            <span class="text-red-500 text-sm">{{ $errors->first('time') }}</span>
                            @endif
                            <div>
                                <label for="reason">reason | السبب</label>
                                <input type="text" name="reason" value="{{ $permission->reason }}"
                                    class="w-full bg-gray-50 border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:border-blue-500">

                                @if ($errors->has('reason'))
                                <span class="text-red-500 text-sm">{{ $errors->first('reason') }}</span>
                                @endif
                            </div>
                            <div class="flex items-center gap-2">
                                <label class="mr-2">
                                    <input type="radio" name="status" value="in" class="rounded-md text-gray-600" {{
                                        $permission->status === 'in' ? 'checked' : '' }}>
                                    <span class="text-sm">In | دخول</span>
                                </label>
                                <label>
                                    <input type="radio" name="status" value="out" class="rounded-md text-gray-600" {{
                                        $permission->status === 'out' ? 'checked' : '' }}>
                                    <span class="text-sm">Out | خروج</span>
                                </label>

                                @if ($errors->has('status'))
                                <span class="text-red-500 text-sm block">{{ $errors->first('status') }}</span>
                                @endif
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