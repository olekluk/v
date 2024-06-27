<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('License detail') }}
        </h2>
    </header>

    <div class="py-6">

        <?php
        $supported_until = \Carbon\Carbon::parse($licInfo['supported_until']);
        $sold_at = \Carbon\Carbon::parse($licInfo['sold_at']);
        ?>

        @if ($supported_until->isPast())
        <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-700 dark:text-yellow-300" role="alert">
            <span class="font-medium"> Support expired</span>
        </div>
        @else
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-700 dark:text-green-400" role="alert">
            <span class="font-medium">Supported</span>
        </div>
        @endif

        <p class="text-gray-600 dark:text-gray-400">
            <small>Supported Until: </small>{{ $supported_until->toFormattedDateString() }} <br><br>
            <small>Sold At:</small> {{ $sold_at->toFormattedDateString() }} <br>
            <small>Amount:</small> {{ $licInfo['amount'] }} <br>
            <small>Support Amount:</small> {{ $licInfo['support_amount'] }} <br>
            <small>Buyer:</small> {{ $licInfo['buyer'] }} <br>
            <small>Purchase Count:</small> {{ $licInfo['purchase_count'] }} <br>
            <small>License:</small> {{ $licInfo['license'] }} <br>
            <small>Item Name:</small> {{ $licInfo['item']['name'] }} <br>
            <small>Item Id:</small> {{ $licInfo['item']['id'] }} <br>
        </p>

    </div>
</section>