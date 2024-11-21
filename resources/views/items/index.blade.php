<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('items.create') }}" class="btn btn-primary">
                            Add Item
                        </a>
                    </div>
                    <table class="table-auto w-full border-collapse border border-gray-200 dark:border-gray-700">
                        <thead>
                        <tr>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Name</th>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Price</th>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Quantity</th>
                            <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ $item->name }}</td>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ $item->price }}</td>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">{{ $item->quantity }}</td>
                                <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">
                                    <a href="{{ route('items.show', $item) }}" class="text-blue-500 hover:underline">View</a> |
                                    <a href="{{ route('items.edit', $item) }}" class="text-yellow-500 hover:underline">Edit</a> |
                                    <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline">
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
