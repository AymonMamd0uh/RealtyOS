<div class="p-8">

    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-8">

        {{-- Left --}}
        <div class="flex-1">

            <div class="flex flex-wrap gap-3 mb-5">

                <span
                    class="rounded-full bg-blue-100 dark:bg-blue-900/40 px-4 py-1.5 text-sm font-medium text-blue-700 dark:text-blue-300">

                    {{ ucfirst($record->property_type->value) }}

                </span>

                <span
                    class="rounded-full bg-purple-100 dark:bg-purple-900/40 px-4 py-1.5 text-sm font-medium text-purple-700 dark:text-purple-300">

                    {{ ucfirst($record->listing_type->value) }}

                </span>

                <span
                    class="rounded-full bg-green-100 dark:bg-green-900/40 px-4 py-1.5 text-sm font-medium text-green-700 dark:text-green-300">

                    {{ ucfirst($record->status->value) }}

                </span>

            </div>

            <h1 class="text-4xl font-bold text-gray-900 dark:text-white leading-tight">

                {{ $record->title }}

            </h1>

            <div class="mt-4 flex items-center gap-2 text-gray-500 dark:text-gray-400">

                <span>Reference</span>

                <span class="font-bold text-gray-900 dark:text-white">

                    #{{ $record->reference_number }}

                </span>

            </div>

        </div>

        {{-- Right --}}
        <div class="text-left lg:text-right">

            <div class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wide">

                Price

            </div>

            <div class="mt-2">

                <span class="text-lg text-gray-500 dark:text-gray-400">

                    EGP

                </span>

                <span
                    class="ml-2 text-5xl font-extrabold text-amber-600 dark:text-amber-400">

                    {{ number_format($record->price) }}

                </span>

            </div>

        </div>

    </div>

</div>