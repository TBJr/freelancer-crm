<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Expenses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('expenses.create') }}" class="btn btn-primary">
                            Add Expense
                        </a>
                    </div>
                    <table class="table-auto w-full border-collapse border border-gray-200 dark:border-gray-700">
                        <thead>
                        <tr>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Category</th>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Amount</th>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Description</th>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($expenses as $expense)
                            <tr>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ $expense->category }}</td>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">${{ $expense->amount }}</td>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ $expense->description }}</td>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">
                                    <a href="{{ route('expenses.show', $expense) }}" class="text-blue-500 hover:underline">View</a> |
                                    <a href="{{ route('expenses.edit', $expense) }}" class="text-yellow-500 hover:underline">Edit</a> |
                                    <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
