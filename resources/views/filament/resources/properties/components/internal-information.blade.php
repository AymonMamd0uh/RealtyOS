@if($record->canViewInternalInformation(auth()->user()))

<div class="flex items-center justify-between mb-6">

    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
        🔒 Internal Information
    </h2>

    <span class="text-sm text-gray-500 dark:text-gray-400">
        Visible only to authorized users
    </span>

</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <div>
        <div class="text-sm text-gray-500 dark:text-gray-400">Owner Name</div>
        <div class="font-semibold text-gray-900 dark:text-white">
            {{ $record->owner_name ?: '-' }}
        </div>
    </div>

    <div>
        <div class="text-sm text-gray-500 dark:text-gray-400">Owner Phone</div>
        <div class="font-semibold text-gray-900 dark:text-white">
            {{ $record->owner_phone ?: '-' }}
        </div>
    </div>

    <div>
        <div class="text-sm text-gray-500 dark:text-gray-400">Owner Email</div>
        <div class="font-semibold text-gray-900 dark:text-white">
            {{ $record->owner_email ?: '-' }}
        </div>
    </div>

    <div>
        <div class="text-sm text-gray-500 dark:text-gray-400">Group</div>
        <div class="font-semibold text-gray-900 dark:text-white">
            {{ $record->group_name ?: '-' }}
        </div>
    </div>

    <div>
        <div class="text-sm text-gray-500 dark:text-gray-400">Building</div>
        <div class="font-semibold text-gray-900 dark:text-white">
            {{ $record->building_number ?: '-' }}
        </div>
    </div>

    <div>
        <div class="text-sm text-gray-500 dark:text-gray-400">Unit</div>
        <div class="font-semibold text-gray-900 dark:text-white">
            {{ $record->unit_number ?: '-' }}
        </div>
    </div>

</div>

@if($record->internal_notes)

    <div class="mt-8">

        <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
            Internal Notes
        </div>

        <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 p-4 whitespace-pre-line text-gray-900 dark:text-gray-100">
            {{ $record->internal_notes }}
        </div>

    </div>

@endif

@endif