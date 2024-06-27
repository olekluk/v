<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Local codes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('message') != '')
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <p class="text-lg text-gray-600 dark:text-gray-400">
                        {{ session('message') }}
                    </p>
                </div>
            </div>
            @endif
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-3xl">
                    @include('local.partials.add-local-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-3xl">
                    @include('local.partials.get-local')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>