@props(['notification'])

<div
    class="flex items-center justify-between border-t border-gray-100 bg-gray-50 px-5 py-3 dark:border-gray-700 dark:bg-gray-800/40">

    {{-- Hint --}}
    <div
        class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">

        <x-heroicon-o-cursor-arrow-rays
            class="h-4 w-4"/>

        <span>

            Click anywhere to open

        </span>

    </div>

    {{-- Delete --}}
    <button
        type="button"
        wire:click.stop="deleteNotification('{{ $notification->id }}')"
        wire:confirm="Are you sure you want to delete this notification?"
        class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50 hover:text-red-700 dark:hover:bg-red-900/20">

        <x-heroicon-o-trash
            class="h-5 w-5"/>

        <span>

            Delete

        </span>

    </button>

</div>