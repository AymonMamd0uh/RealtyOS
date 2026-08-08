@if($record->canViewInternalInformation(auth()->user()))

<div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">

    <div class="flex items-center justify-between mb-6">

        <h2 class="text-xl font-bold">
            🔒 Internal Information
        </h2>

        <span class="text-sm text-gray-500">
            Visible only to authorized users
        </span>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <div>
            <div class="text-sm text-gray-500">Owner Name</div>
            <div class="font-semibold">
                {{ $record->owner_name ?: '-' }}
            </div>
        </div>

        <div>
            <div class="text-sm text-gray-500">Owner Phone</div>
            <div class="font-semibold">
                {{ $record->owner_phone ?: '-' }}
            </div>
        </div>

        <div>
            <div class="text-sm text-gray-500">Owner Email</div>
            <div class="font-semibold">
                {{ $record->owner_email ?: '-' }}
            </div>
        </div>

        <div>
            <div class="text-sm text-gray-500">Group</div>
            <div class="font-semibold">
                {{ $record->group_name ?: '-' }}
            </div>
        </div>

        <div>
            <div class="text-sm text-gray-500">Building</div>
            <div class="font-semibold">
                {{ $record->building_number ?: '-' }}
            </div>
        </div>

        <div>
            <div class="text-sm text-gray-500">Unit</div>
            <div class="font-semibold">
                {{ $record->unit_number ?: '-' }}
            </div>
        </div>

    </div>

    @if($record->internal_notes)

        <div class="mt-8">

            <div class="text-sm text-gray-500 mb-2">
                Internal Notes
            </div>

            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 whitespace-pre-line">
                {{ $record->internal_notes }}
            </div>

        </div>

    @endif

</div>

@endif