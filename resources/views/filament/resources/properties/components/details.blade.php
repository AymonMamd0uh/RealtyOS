<div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">

    <h2 class="text-xl font-bold mb-6">
        Property Details
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

        <div>
            <p class="text-sm text-gray-500">Property Type</p>
            <p class="font-semibold mt-1">
                {{ ucfirst($record->property_type->value) }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Listing Type</p>
            <p class="font-semibold mt-1">
                {{ ucfirst($record->listing_type->value) }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Status</p>
            <p class="font-semibold mt-1">
                {{ ucfirst($record->status->value) }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Built Area</p>
            <p class="font-semibold mt-1">
                {{ $record->built_area ?? '-' }} m²
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Land Area</p>
            <p class="font-semibold mt-1">
                {{ $record->land_area ?? '-' }} m²
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Floor</p>
            <p class="font-semibold mt-1">
                {{ $record->floor_number ?? '-' }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Bedrooms</p>
            <p class="font-semibold mt-1">
                {{ $record->bedrooms ?? '-' }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Bathrooms</p>
            <p class="font-semibold mt-1">
                {{ $record->bathrooms ?? '-' }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Furnished</p>
            <p class="font-semibold mt-1">
                {{ $record->is_furnished ? 'Yes' : 'No' }}
            </p>
        </div>

    </div>

</div>