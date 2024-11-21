<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invoice Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p><strong>Customer:</strong> {{ $invoice->customer->name }}</p>
                    <p><strong>Total:</strong> ${{ $invoice->total }}</p>
                    <p><strong>Tax:</strong> ${{ $invoice->tax }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($invoice->status) }}</p>

                    <h3 class="mt-6 text-lg font-semibold">Invoice Items</h3>
                    <table class="table-auto w-full border-collapse border border-gray-200 dark:border-gray-700 mt-4">
                        <thead>
                        <tr>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Item</th>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Quantity</th>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Price</th>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($invoice->items as $item)
                            <tr>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ $item->item->name }}</td>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ $item->quantity }}</td>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">${{ $item->price }}</td>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">${{ $item->total }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('invoices.index') }}" class="mt-6 inline-block text-blue-500 hover:underline">Back to Invoices</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
