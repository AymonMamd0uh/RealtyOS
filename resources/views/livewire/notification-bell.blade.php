@php
    use Illuminate\Support\Str;
@endphp

<div
    x-data="{ open: false }"
    class="relative"
    wire:poll.30s>

    {{-- Bell --}}
    <button
        @click="open = ! open"
        class="relative flex h-10 w-10 items-center justify-center rounded-xl transition hover:bg-gray-100 dark:hover:bg-gray-800">

        <x-heroicon-o-bell class="h-6 w-6 text-gray-700 dark:text-gray-200"/>

        @if($this->unreadCount > 0)

            <span
                class="absolute -right-1 -top-1 flex min-w-[20px] items-center justify-center rounded-full bg-orange-600 px-1.5 py-0.5 text-[11px] font-bold leading-none text-white">

                {{ $this->unreadCount > 99 ? '99+' : $this->unreadCount }}

            </span>

        @endif

    </button>

    {{-- Dropdown --}}
    <div
        x-show="open"
        @click.outside="open = false"
        x-transition.origin.top.right
        x-cloak
        class="absolute right-0 z-50 mt-3 w-[95vw] max-w-md overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-2xl dark:border-gray-700 dark:bg-gray-900">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-700">

            <div>

                <h3 class="font-semibold text-gray-900 dark:text-white">

                    Notifications

                </h3>

                <p class="mt-1 text-xs text-gray-500">

                    @if($this->unreadCount)

                        {{ $this->unreadCount }}
                        {{ Str::plural('unread notification', $this->unreadCount) }}

                    @else

                        You're all caught up 🎉

                    @endif

                </p>

            </div>

            @if($this->unreadCount)

                <button
                    wire:click="markAllAsRead"
                    class="rounded-lg px-3 py-2 text-xs font-medium text-orange-600 transition hover:bg-orange-50 hover:text-orange-700 dark:hover:bg-orange-900/20">

                    Mark all

                </button>

            @endif

        </div>

        {{-- Notifications --}}
        <div class="max-h-[430px] overflow-y-auto">

            @forelse($this->notifications as $notification)

                @include(
                    'livewire.notifications.dropdown-item',
                    ['notification' => $notification]
                )

            @empty

                <div class="px-8 py-12 text-center">

                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900/20">

                        <x-heroicon-o-bell
                            class="h-8 w-8 text-orange-500"/>

                    </div>

                    <h4
                        class="mt-5 text-lg font-semibold text-gray-900 dark:text-white">

                        You're all caught up

                    </h4>

                    <p
                        class="mt-2 text-sm text-gray-500 dark:text-gray-400">

                        No new notifications.

                    </p>

                </div>

            @endforelse

        </div>

        {{-- Footer --}}
        <div
            class="flex items-center justify-between border-t border-gray-200 bg-gray-50 px-5 py-4 dark:border-gray-700 dark:bg-gray-800">

            <button
                wire:click="markAllAsRead"
                @disabled($this->unreadCount === 0)
                class="text-sm font-medium text-orange-600 transition hover:text-orange-700 disabled:cursor-not-allowed disabled:opacity-50">

                Mark all as read

            </button>

            <a
                href="{{ route('filament.admin.pages.notifications') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-orange-600 transition hover:text-orange-700">

                <span>

                    View all

                </span>

                <x-heroicon-o-arrow-right class="h-4 w-4"/>

            </a>

        </div>

    </div>

</div>

@script
<script>
    window.Echo.private('App.Models.User.{{ auth()->id() }}')
        .notification(() => {
            $wire.realtimeNotification();
        });
</script>
@endscript