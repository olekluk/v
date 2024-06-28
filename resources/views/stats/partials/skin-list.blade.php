<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Skins') }}
        </h2>
    </header>

    <div class="py-6">
        {{ $data->links() }}
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-600 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Skin name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr class="bg-white dark:bg-gray-800 border-b  dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->themeName }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->total }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>