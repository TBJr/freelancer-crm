<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('payments.create') }}" class="btn btn-primary">
                            Add Payment
                        </a>
                    </div>
                    <table class="table-auto w-full border-collapse border border-gray-200 dark:border-gray-700">
                        <thead>
                        <tr>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Invoice</th>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Amount</th>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Payment Date</th>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Method</th>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ $payment->invoice->id }}</td>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">${{ $payment->amount }}</td>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ $payment->payment_date }}</td>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ ucfirst($payment->payment_method ?? 'N/A') }}</td>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">
                                    <a href="{{ route('payments.show', $payment) }}" class="text-blue-500 hover:underline">View</a> |
                                    <a href="{{ route('payments.edit', $payment) }}" class="text-yellow-500 hover:underline">Edit</a> |
                                    <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="inline">
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
