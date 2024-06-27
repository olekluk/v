<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Local codes') }}
        </h2>
    </header>

    <div class="py-6">
        {{ $codes->links() }}
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-600 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Local code
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Theme ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($codes as $code)
                <tr class="bg-white dark:bg-gray-800 border-b  dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $code->lic }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $code->themeId }}
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('local.delete') }}" method="post">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $code->id }}">
                            <x-danger-button onclick="return confirm('Are you sure you want to DELETE?')">Delete</x-danger-button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</section>