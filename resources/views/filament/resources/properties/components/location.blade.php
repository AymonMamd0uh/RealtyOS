<h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">

    Property Location

</h2>

<div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

    <div>

        <div class="text-gray-500 dark:text-gray-400 text-sm">
            City
        </div>

        <div class="font-semibold mt-2 text-gray-900 dark:text-white">
            {{ $record->city?->name ?? '-' }}
        </div>

    </div>

    <div>

        <div class="text-gray-500 dark:text-gray-400 text-sm">
            Area
        </div>

        <div class="font-semibold mt-2 text-gray-900 dark:text-white">
            {{ $record->area?->name ?? '-' }}
        </div>

    </div>

    <div>

        <div class="text-gray-500 dark:text-gray-400 text-sm">
            Compound
        </div>

        <div class="font-semibold mt-2 text-gray-900 dark:text-white">
            {{ $record->compound?->name ?? '-' }}
        </div>

    </div>

    <div>

        <div class="text-gray-500 dark:text-gray-400 text-sm">
            Stage
        </div>

        <div class="font-semibold mt-2 text-gray-900 dark:text-white">
            {{ $record->stage?->name ?? '-' }}
        </div>

    </div>

</div>