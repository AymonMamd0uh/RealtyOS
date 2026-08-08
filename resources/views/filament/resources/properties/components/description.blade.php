<div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6">

    <h2 class="text-xl font-bold mb-5">
        Description
    </h2>

    <div class="prose max-w-none text-gray-700 leading-8">

        @if($record->description)

            {{ $record->description }}

        @else

            <span class="text-gray-400">
                No description available.
            </span>

        @endif

    </div>

</div>