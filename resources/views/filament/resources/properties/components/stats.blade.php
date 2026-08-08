<div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-8 gap-5">

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
        <div class="text-sm text-gray-500">Bedrooms</div>
        <div class="mt-2 text-2xl font-bold truncate">
            {{ $record->bedrooms ?? '-' }}
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
        <div class="text-sm text-gray-500">Bathrooms</div>
        <div class="mt-2 text-2xl font-bold truncate">
            {{ $record->bathrooms ?? '-' }}
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
        <div class="text-sm text-gray-500">Built Area</div>
        <div class="mt-2 text-2xl font-bold truncate">
            {{ number_format($record->built_area, 2) }} m²
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
        <div class="text-sm text-gray-500">Land Area</div>
        <div class="mt-2 text-2xl font-bold truncate">
            {{ number_format($record->land_area, 2) }} m²
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
        <div class="text-sm text-gray-500">Floor</div>
        <div class="mt-2 text-2xl font-bold truncate">
            {{ $record->floor_number ?? '-' }}
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
        <div class="text-sm text-gray-500">Furnished</div>
        <div class="mt-2 text-lg font-bold">
            {{ $record->is_furnished ? 'Yes' : 'No' }}
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
        <div class="text-sm text-gray-500">Agent</div>
        <div class="mt-2 font-semibold">
            {{ $record->user?->name ?? '-' }}
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
        <div class="text-sm text-gray-500">Company</div>
        <div class="mt-2 font-semibold">
            {{ $record->company?->name ?? '-' }}
        </div>
    </div>

</div>