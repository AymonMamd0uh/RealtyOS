<h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">
    Property Details
</h2>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

    <div>
        <p class="text-sm text-gray-500 dark:text-gray-400">Property Type</p>
        <p class="font-semibold mt-1 text-gray-900 dark:text-white">
            {{ ucfirst($record->property_type->value) }}
        </p>
    </div>

    <div>
        <p class="text-sm text-gray-500 dark:text-gray-400">Listing Type</p>
        <p class="font-semibold mt-1 text-gray-900 dark:text-white">
            {{ ucfirst($record->listing_type->value) }}
        </p>
    </div>

    <div>
        <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
        <p class="font-semibold mt-1 text-gray-900 dark:text-white">
            {{ ucfirst($record->status->value) }}
        </p>
    </div>

    <div>
        <p class="text-sm text-gray-500 dark:text-gray-400">Built Area</p>
        <p class="font-semibold mt-1 text-gray-900 dark:text-white">
            {{ $record->built_area ?? '-' }} m²
        </p>
    </div>

    <div>
        <p class="text-sm text-gray-500 dark:text-gray-400">Land Area</p>
        <p class="font-semibold mt-1 text-gray-900 dark:text-white">
            {{ $record->land_area ?? '-' }} m²
        </p>
    </div>

    <div>
        <p class="text-sm text-gray-500 dark:text-gray-400">Floor</p>
        <p class="font-semibold mt-1 text-gray-900 dark:text-white">
            {{ $record->floor_number ?? '-' }}
        </p>
    </div>

    <div>
        <p class="text-sm text-gray-500 dark:text-gray-400">Bedrooms</p>
        <p class="font-semibold mt-1 text-gray-900 dark:text-white">
            {{ $record->bedrooms ?? '-' }}
        </p>
    </div>

    <div>
        <p class="text-sm text-gray-500 dark:text-gray-400">Bathrooms</p>
        <p class="font-semibold mt-1 text-gray-900 dark:text-white">
            {{ $record->bathrooms ?? '-' }}
        </p>
    </div>

    <div>
        <p class="text-sm text-gray-500 dark:text-gray-400">Furnished</p>
        <p class="font-semibold mt-1 text-gray-900 dark:text-white">
            {{ $record->is_furnished ? 'Yes' : 'No' }}
        </p>
    </div>

</div>