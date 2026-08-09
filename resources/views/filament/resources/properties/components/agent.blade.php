<h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">

    Assigned Agent

</h2>

<div class="flex items-center gap-5">

    <div
        class="flex h-20 w-20 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900/40 text-3xl font-bold text-primary-700 dark:text-primary-300">

        {{ strtoupper(substr($record->user?->name ?? 'A',0,1)) }}

    </div>

    <div>

        <div class="text-xl font-semibold text-gray-900 dark:text-white">

            {{ $record->user?->name }}

        </div>

        <div class="text-gray-500 dark:text-gray-400 mt-2">

            {{ $record->company?->name }}

        </div>

    </div>

</div>