<h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">
    Property Actions
</h2>

<div class="flex flex-wrap gap-4">

    <a
        href="{{ route('properties.pdf', ['property' => $record->id]) }}"
        class="inline-flex items-center gap-2 rounded-xl bg-primary-600 px-5 py-3 font-semibold text-white transition hover:bg-primary-700 dark:bg-primary-500 dark:hover:bg-primary-600"
    >
        📄 Download PDF
    </a>

    <a
        href="{{ route('properties.images', ['property' => $record->id]) }}"
        class="inline-flex items-center gap-2 rounded-xl bg-gray-100 px-5 py-3 font-semibold text-gray-900 transition hover:bg-gray-200 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600"
    >
        📦 Download Images
    </a>

</div>