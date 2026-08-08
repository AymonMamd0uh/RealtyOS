<div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-gray-300 bg-white px-8 py-20 text-center dark:border-gray-700 dark:bg-gray-900">

    {{-- Icon --}}
    <div
        class="flex h-20 w-20 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900/20">

        <x-heroicon-o-bell
            class="h-10 w-10 text-orange-500"/>

    </div>

    {{-- Title --}}
    <h3
        class="mt-6 text-2xl font-bold text-gray-900 dark:text-white">

        You're all caught up!

    </h3>

    {{-- Description --}}
    <p
        class="mt-3 max-w-md text-sm leading-6 text-gray-500 dark:text-gray-400">

        You don't have any notifications right now.
        New leads, follow-ups, property updates, subscriptions,
        and other important activities will appear here.

    </p>

    {{-- Tips --}}
    <div
        class="mt-8 rounded-xl bg-gray-50 px-6 py-4 dark:bg-gray-800">

        <div class="flex items-center gap-3">

            <x-heroicon-o-light-bulb
                class="h-5 w-5 text-orange-500"/>

            <span
                class="text-sm text-gray-600 dark:text-gray-300">

                Notifications will automatically appear as your workspace becomes active.

            </span>

        </div>

    </div>

</div>