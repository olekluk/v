<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Stores') }}
        </h2>
    </header>

    <div class="py-6">
        {{ $stores->links() }}
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-600 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Store url
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Customer
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Purchase code
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Added
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Theme id
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($stores as $store)
                <tr class="@if ($store->active == 0) bg-red-100 dark:bg-red-800 @else bg-white dark:bg-gray-800 @endif border-b  dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $store->url }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $store->customer }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $store->lic }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $store->created_at }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $store->themeId }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>