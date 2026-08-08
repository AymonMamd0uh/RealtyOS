<div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">

    <h2 class="text-xl font-bold mb-6">

        Assigned Agent

    </h2>

    <div class="flex items-center gap-5">

        <div
            class="flex h-20 w-20 items-center justify-center rounded-full bg-primary-100 text-3xl font-bold">

            {{ strtoupper(substr($record->user?->name ?? 'A',0,1)) }}

        </div>

        <div>

            <div class="text-xl font-semibold">

                {{ $record->user?->name }}

            </div>

            <div class="text-gray-500 mt-2">

                {{ $record->company?->name }}

            </div>

        </div>

    </div>

</div>