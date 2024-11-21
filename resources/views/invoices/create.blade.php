<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('invoices.store') }}" method="POST" class="space-y-6 bg-white dark:bg-gray-800 p-8 rounded-md shadow-md">
                    @csrf
                    <div>
                        <label for="customer_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer</label>
                        <select
                            name="customer_id"
                            id="customer_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                                required>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="invoice-items" class="space-y-4">
                        <div class="item flex space-x-4">
                            <select
                                name="items[0][item_id]"
                                class="w-1/3 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                                required>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <input
                                type="number"
                                name="items[0][quantity]"
                                placeholder="Quantity"
                                class="w-1/3 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                                required>
                            <input
                                type="number"
                                name="items[0][price]"
                                placeholder="Price"
                                class="w-1/3 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300"
                                required>
                            <button type="button" onclick="removeItem(this)" class="text-red-500 hover:text-red-700 font-medium">Remove</button>
                        </div>
                    </div>

                    <button type="button" onclick="addItem()" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Add Item
                    </button>

                    <div class="mt-6">
                        <label class="flex items-center">
                            <input
                                type="checkbox"
                                name="is_recurring"
                                class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Recurring Invoice</span>
                        </label>
                        <select
                            name="recurring_period"
                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                            <option value="">Select Recurring Period</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>

                    <button type="submit" class="mt-6 w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create Invoice
                    </button>
                </form>

                <script>
                    let itemIndex = 1;
                    function addItem() {
                        const container = document.getElementById('invoice-items');
                        const newItem = document.createElement('div');
                        newItem.classList.add('item', 'flex', 'space-x-4');
                        newItem.innerHTML = `
                            <select name="items[${itemIndex}][item_id]" class="w-1/3 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="items[${itemIndex}][quantity]" placeholder="Quantity" class="w-1/3 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                            <input type="number" name="items[${itemIndex}][price]" placeholder="Price" class="w-1/3 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                            <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 font-medium">Remove</button>
                        `;
                        container.appendChild(newItem);
                        itemIndex++;
                    }
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
