<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payment Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p><strong>Invoice:</strong> Invoice #{{ $payment->invoice->id }}</p>
                    <p><strong>Amount:</strong> ${{ $payment->amount }}</p>
                    <p><strong>Payment Date:</strong> {{ $payment->payment_date }}</p>
                    <p><strong>Method:</strong> {{ ucfirst($payment->payment_method ?? 'N/A') }}</p>
                    <a href="{{ route('payments.index') }}" class="text-blue-500 hover:underline">Back to Payments</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
