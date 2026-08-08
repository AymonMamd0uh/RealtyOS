<div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">

    <h2 class="text-xl font-bold mb-6">
        Features & Amenities
    </h2>

    @if($record->features->count())

        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">

            @foreach($record->features as $feature)

                <div
                    class="flex items-center gap-3 rounded-xl border border-gray-200 bg-gray-50 px-4 py-3">

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-primary-100">

                        ✅

                    </div>

                    <span class="font-medium">

                        {{ $feature->name }}

                    </span>

                </div>

            @endforeach

        </div>

    @else

        <div class="text-gray-400">

            No features available.

        </div>

    @endif

</div>