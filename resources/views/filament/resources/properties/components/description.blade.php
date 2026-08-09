<h2 class="text-xl font-bold mb-5 text-gray-900 dark:text-white">
    Description
</h2>

<div class="prose max-w-none text-gray-700 dark:text-gray-300 leading-8">

    @if($record->description)

        {{ $record->description }}

    @else

        <span class="text-gray-400 dark:text-gray-500">
            No description available.
        </span>

    @endif

</div>