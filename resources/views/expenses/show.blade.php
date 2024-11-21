<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Expense Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p><strong>Category:</strong> {{ $expense->category }}</p>
                    <p><strong>Amount:</strong> ${{ $expense->amount }}</p>
                    <p><strong>Description:</strong> {{ $expense->description }}</p>
                    <a href="{{ route('expenses.index') }}" class="text-blue-500 hover:underline">Back to Expenses</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
