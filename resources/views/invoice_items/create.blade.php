<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Invoice Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('invoice_items.store') }}" method="POST">
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
                            <label for="item_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Item</label>
                            <select id="item_id" name="item_id" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                            <input type="number" id="quantity" name="quantity" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                            <input type="number" id="price" name="price" step="0.01" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
