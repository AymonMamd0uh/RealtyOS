<h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">
    Features & Amenities
</h2>

@if($record->features->count())

    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">

        @foreach($record->features as $feature)

            <div
                class="flex items-center gap-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-4 py-3">

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900/40">

                    ✅

                </div>

                <span class="font-medium text-gray-900 dark:text-white">

                    {{ $feature->name }}

                </span>

            </div>

        @endforeach

    </div>

@else

    <div class="text-gray-400 dark:text-gray-500">

        No features available.

    </div>

@endif