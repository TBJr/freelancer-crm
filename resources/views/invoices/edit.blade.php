<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('invoices.update', $invoice) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="customer_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer</label>
                            <select id="customer_id" name="customer_id" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" @if($invoice->customer_id == $customer->id) selected @endif>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="total" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total</label>
                            <input type="number" id="total" name="total" value="{{ $invoice->total }}" step="0.01" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                        </div>
                        <div class="mb-4">
                            <label for="tax" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tax</label>
                            <input type="number" id="tax" name="tax" value="{{ $invoice->tax }}" step="0.01" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select id="status" name="status" class="mt-1 block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                                <option value="pending" @if($invoice->status == 'pending') selected @endif>Pending</option>
                                <option value="paid" @if($invoice->status == 'paid') selected @endif>Paid</option>
                                <option value="cancelled" @if($invoice->status == 'cancelled') selected @endif>Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
