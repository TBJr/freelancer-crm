<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Project Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p><strong>Name:</strong> {{ $project->name }}</p>
                    <p><strong>Customer:</strong> {{ $project->customer->name }}</p>
                    <p><strong>Start Date:</strong> {{ $project->start_date }}</p>
                    <p><strong>End Date:</strong> {{ $project->end_date ?? 'Ongoing' }}</p>
                    <p><strong>Description:</strong> {{ $project->description }}</p>
                    <a href="{{ route('projects.index') }}" class="text-blue-500 hover:underline">Back to Projects</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
