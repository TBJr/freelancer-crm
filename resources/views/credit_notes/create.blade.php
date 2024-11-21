<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Credit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('credit_notes.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="invoice_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Invoice</label>
                            <select id="invoice_id" name="invoice_id" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                                @foreach ($invoices as $invoice)
                                    <option value="{{ $invoice->id }}">Invoice #{{ $invoice->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
                            <input type="number" id="amount" name="amount" step="0.01" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                        </div>
                        <div class="mb-4">
                            <label for="reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reason</label>
                            <textarea id="reason" name="reason" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"></textarea>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>