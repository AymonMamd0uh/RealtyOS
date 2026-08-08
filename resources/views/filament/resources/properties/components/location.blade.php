<div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">

    <h2 class="text-xl font-bold mb-6">

        Property Location

    </h2>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

        <div>

            <div class="text-gray-500 text-sm">
                City
            </div>

            <div class="font-semibold mt-2">
                {{ $record->city?->name ?? '-' }}
            </div>

        </div>

        <div>

            <div class="text-gray-500 text-sm">
                Area
            </div>

            <div class="font-semibold mt-2">
                {{ $record->area?->name ?? '-' }}
            </div>

        </div>

        <div>

            <div class="text-gray-500 text-sm">
                Compound
            </div>

            <div class="font-semibold mt-2">
                {{ $record->compound?->name ?? '-' }}
            </div>

        </div>

        <div>

            <div class="text-gray-500 text-sm">
                Stage
            </div>

            <div class="font-semibold mt-2">
                {{ $record->stage?->name ?? '-' }}
            </div>

        </div>

    </div>

</div>