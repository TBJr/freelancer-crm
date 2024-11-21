<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invoice Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Customer and Invoice Details -->
                    <div class="space-y-4">
                        <p><strong>Customer:</strong> {{ $invoice->customer->name }}</p>
                        <p><strong>Total:</strong> ${{ number_format($invoice->total, 2) }}</p>
                        <p><strong>Tax:</strong> ${{ number_format($invoice->tax, 2) }}</p>
                        <p><strong>Status:</strong> <span class="px-2 py-1 rounded text-sm font-medium
                            {{ $invoice->status === 'paid' ? 'bg-green-200 text-green-800' : ($invoice->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                            {{ ucfirst($invoice->status) }}
                        </span></p>
                    </div>

                    <!-- Invoice Items -->
                    <h3 class="mt-6 text-lg font-semibold">Invoice Items</h3>
                    <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-700 mt-4">
                        <thead class="bg-gray-100 dark:bg-gray-900">
                        <tr>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-left">Item</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">Quantity</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-right">Price</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-right">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($invoice->items as $item)
                            <tr>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">{{ $item->item->name }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">{{ $item->quantity }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-right">${{ number_format($item->price, 2) }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-right">${{ number_format($item->total, 2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Back to Invoices Button -->
                    <div class="mt-6">
                        <a href="{{ route('invoices.index') }}" class="inline-block px-4 py-2 bg-blue-600 text-white font-medium text-sm rounded-md shadow hover:bg-blue-700">
                            Back to Invoices
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
