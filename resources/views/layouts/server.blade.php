<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Server') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            @php
            $host = gethostname();
            echo $host . " - " . gethostbyname($host);
            @endphp
        </p>
    </header>
</section>