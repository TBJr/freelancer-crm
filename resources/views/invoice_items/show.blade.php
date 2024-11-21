<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invoice Item Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p><strong>Invoice:</strong> Invoice #{{ $invoiceItem->invoice->id }}</p>
                    <p><strong>Item:</strong> {{ $invoiceItem->item->name }}</p>
                    <p><strong>Quantity:</strong> {{ $invoiceItem->quantity }}</p>
                    <p><strong>Price:</strong> ${{ $invoiceItem->price }}</p>
                    <p><strong>Total:</strong> ${{ $invoiceItem->total }}</p>
                    <a href="{{ route('invoice_items.index') }}" class="text-blue-500 hover:underline">Back to Invoice Items</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
