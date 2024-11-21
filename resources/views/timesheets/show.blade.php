<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Timesheet Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p><strong>Project:</strong> {{ $timesheet->project->name }}</p>
                    <p><strong>User:</strong> {{ $timesheet->user->name }}</p>
                    <p><strong>Hours:</strong> {{ $timesheet->hours }}</p>
                    <p><strong>Date:</strong> {{ $timesheet->date }}</p>
                    <a href="{{ route('timesheets.index') }}" class="text-blue-500 hover:underline">Back to Timesheets</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
