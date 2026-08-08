<div class="space-y-4">

    {{-- Search --}}
    <div class="relative">

        <div
            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

            <x-heroicon-o-magnifying-glass
                class="h-5 w-5 text-gray-400"/>

        </div>

        <input
            type="text"
            wire:model.live.debounce.400ms="search"
            placeholder="Search notifications..."
            class="w-full rounded-2xl border border-gray-300 bg-white py-3 pl-11 pr-4 text-sm shadow-sm transition duration-200 placeholder:text-gray-400 focus:border-orange-500 focus:ring-2 focus:ring-orange-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500">

    </div>

    {{-- Filters --}}
    <div class="flex flex-wrap items-center gap-2">

        {{-- All --}}
        <button
            wire:click="$set('filter','all')"
            class="rounded-full px-4 py-2 text-sm font-medium transition duration-200

            {{ $filter === 'all'
                ? 'bg-orange-500 text-white shadow'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700' }}">

            All ({{ $this->counts['all'] }})

        </button>

        {{-- Unread --}}
        <button
            wire:click="$set('filter','unread')"
            class="rounded-full px-4 py-2 text-sm font-medium transition duration-200

            {{ $filter === 'unread'
                ? 'bg-orange-500 text-white shadow'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700' }}">

            <span class="inline-flex items-center gap-2">

                <span class="h-2 w-2 rounded-full bg-orange-500"></span>

                Unread ({{ $this->counts['unread'] }})

            </span>

        </button>

        {{-- Read --}}
        <button
            wire:click="$set('filter','read')"
            class="rounded-full px-4 py-2 text-sm font-medium transition duration-200

            {{ $filter === 'read'
                ? 'bg-orange-500 text-white shadow'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700' }}">

            <span class="inline-flex items-center gap-2">

                <x-heroicon-o-check-circle
                    class="h-4 w-4"/>

                Read ({{ $this->counts['read'] }})

            </span>

        </button>

    </div>

</div>