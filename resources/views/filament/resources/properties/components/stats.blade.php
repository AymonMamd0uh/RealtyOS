<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5">
    <div class="text-sm text-gray-500 dark:text-gray-400">Bedrooms</div>
    <div class="mt-2 text-2xl font-bold text-gray-900 dark:text-white truncate">
        {{ $record->bedrooms ?? '-' }}
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5">
    <div class="text-sm text-gray-500 dark:text-gray-400">Bathrooms</div>
    <div class="mt-2 text-2xl font-bold text-gray-900 dark:text-white truncate">
        {{ $record->bathrooms ?? '-' }}
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5">
    <div class="text-sm text-gray-500 dark:text-gray-400">Built Area</div>
    <div class="mt-2 text-2xl font-bold text-gray-900 dark:text-white truncate">
        {{ number_format($record->built_area, 2) }} m²
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5">
    <div class="text-sm text-gray-500 dark:text-gray-400">Land Area</div>
    <div class="mt-2 text-2xl font-bold text-gray-900 dark:text-white truncate">
        {{ number_format($record->land_area, 2) }} m²
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5">
    <div class="text-sm text-gray-500 dark:text-gray-400">Floor</div>
    <div class="mt-2 text-2xl font-bold text-gray-900 dark:text-white truncate">
        {{ $record->floor_number ?? '-' }}
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5">
    <div class="text-sm text-gray-500 dark:text-gray-400">Furnished</div>
    <div class="mt-2 text-lg font-bold text-gray-900 dark:text-white">
        {{ $record->is_furnished ? 'Yes' : 'No' }}
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5">
    <div class="text-sm text-gray-500 dark:text-gray-400">Agent</div>
    <div class="mt-2 font-semibold text-gray-900 dark:text-white">
        {{ $record->user?->name ?? '-' }}
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5">
    <div class="text-sm text-gray-500 dark:text-gray-400">Company</div>
    <div class="mt-2 font-semibold text-gray-900 dark:text-white">
        {{ $record->company?->name ?? '-' }}
    </div>
</div>