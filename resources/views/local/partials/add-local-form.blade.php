<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add local code.') }}
        </h2>
    </header>

    <form method="post" action="{{ route('local.add') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-text-input id="lic" name="lic" type="text" class="mt-1 block w-full" required autofocus placeholder="loc-xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx-username" />
        </div>
        <div>
            <select id="themeid" name="themeid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($themes as $theme)
                <option value="{{ $theme->themeId }}">{{ $theme->themeName }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Add') }}</x-primary-button>
        </div>
    </form>
</section>