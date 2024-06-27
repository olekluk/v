<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Get all active stores') }}
        </h2>
    </header>

    <form method="get" action="{{ route('info.all') }}" class="mt-6 space-y-6">
        @csrf

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Get all') }}</x-primary-button>
        </div>
    </form>
</section>