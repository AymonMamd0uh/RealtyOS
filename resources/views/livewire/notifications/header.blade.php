<div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

    {{-- Left --}}
    <div>

        <p class="text-sm text-gray-500 dark:text-gray-400">

            Stay updated with everything happening in your workspace.

        </p>

    </div>

    {{-- Right --}}
    <div class="flex flex-wrap items-center gap-3">

        <button
            wire:click="markAllAsRead"
            @disabled($this->unreadCount === 0)
            class="inline-flex items-center gap-2 rounded-xl border border-orange-200 bg-orange-50 px-4 py-2.5 text-sm font-medium text-orange-700 transition duration-200 hover:bg-orange-100 disabled:cursor-not-allowed disabled:opacity-50 dark:border-orange-700 dark:bg-orange-900/20 dark:text-orange-300 dark:hover:bg-orange-900/40">

            <x-heroicon-o-check-circle class="h-5 w-5"/>

            <span>

                Mark all as read

            </span>

        </button>

        <button
            wire:click="clearRead"
            @disabled($this->notifications->whereNotNull('read_at')->count() === 0)
            class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-medium text-red-700 transition duration-200 hover:bg-red-100 disabled:cursor-not-allowed disabled:opacity-50 dark:border-red-700 dark:bg-red-900/20 dark:text-red-300 dark:hover:bg-red-900/40">

            <x-heroicon-o-trash class="h-5 w-5"/>

            <span>

                Clear read

            </span>

        </button>

    </div>

</div>