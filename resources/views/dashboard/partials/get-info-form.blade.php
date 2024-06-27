<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Search by username, purchase code or store url') }}
        </h2>
    </header>

    <form method="post" action="{{ route('info.search') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-text-input id="lic" name="lic" type="text" class="mt-1 block w-full" required autofocus placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx or themeforest user name or clientstore.myshopify.com" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Search') }}</x-primary-button>
        </div>
    </form>
</section>