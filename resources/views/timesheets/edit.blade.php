<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Timesheet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('timesheets.update', $timesheet) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="project_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project</label>
                            <select id="project_id" name="project_id" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" @if ($timesheet->project_id == $project->id) selected @endif>{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User</label>
                            <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if ($timesheet->user_id == $user->id) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="hours" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hours</label>
                            <input type="number" id="hours" name="hours" value="{{ $timesheet->hours }}" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                        </div>
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                            <input type="date" id="date" name="date" value="{{ $timesheet->date }}" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
