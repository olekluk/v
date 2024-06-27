<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Deactivate purchase code') }}
        </h2>
    </header>

    <form method="post" action="{{ route('deactivate') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-text-input id="lic" name="lic" type="text" class="mt-1 block w-full" required autofocus placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" />
        </div>

        <div class="flex items-center gap-4">
            <x-danger-button>{{ __('Deactivate') }}</x-danger-button>
        </div>
    </form>
</section>