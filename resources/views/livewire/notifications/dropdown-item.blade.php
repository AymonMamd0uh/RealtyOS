@props(['notification'])

@php
    $type = $notification->data['type'] ?? 'system';

    $config = match ($type) {

        'lead_assigned' => [
            'icon' => 'heroicon-o-user',
            'badge' => 'Lead',
            'color' => 'text-blue-600 bg-blue-100 dark:bg-blue-900/20 dark:text-blue-300',
        ],

        'follow_up' => [
            'icon' => 'heroicon-o-calendar-days',
            'badge' => 'Follow Up',
            'color' => 'text-orange-600 bg-orange-100 dark:bg-orange-900/20 dark:text-orange-300',
        ],

        'property' => [
            'icon' => 'heroicon-o-home',
            'badge' => 'Property',
            'color' => 'text-green-600 bg-green-100 dark:bg-green-900/20 dark:text-green-300',
        ],

        'subscription' => [
            'icon' => 'heroicon-o-credit-card',
            'badge' => 'Subscription',
            'color' => 'text-purple-600 bg-purple-100 dark:bg-purple-900/20 dark:text-purple-300',
        ],

        default => [
            'icon' => 'heroicon-o-bell',
            'badge' => 'Notification',
            'color' => 'text-gray-600 bg-gray-100 dark:bg-gray-800 dark:text-gray-300',
        ],

    };
@endphp

<button
    wire:click="openNotification('{{ $notification->id }}')"
    class="group flex w-full items-start gap-3 border-b border-gray-100 px-4 py-4 text-left transition hover:bg-gray-50 dark:border-gray-800 dark:hover:bg-gray-800/60">

    {{-- Status --}}
    <div class="mt-1 flex-shrink-0">

        @if(!$notification->read_at)

            <div class="h-2.5 w-2.5 rounded-full bg-orange-500 animate-pulse"></div>

        @else

            <div class="h-2.5 w-2.5 rounded-full bg-gray-300"></div>

        @endif

    </div>

    {{-- Icon --}}
<div
    class="flex h-10 w-10 items-center justify-center rounded-xl {{ $config['color'] }}">

    @if($type === 'lead_assigned')

        <x-heroicon-o-user class="h-5 w-5"/>

    @elseif($type === 'follow_up')

        <x-heroicon-o-calendar-days class="h-5 w-5"/>

    @elseif($type === 'property')

        <x-heroicon-o-home class="h-5 w-5"/>

    @elseif($type === 'subscription')

        <x-heroicon-o-credit-card class="h-5 w-5"/>

    @else

        <x-heroicon-o-bell class="h-5 w-5"/>

    @endif

</div>

    {{-- Content --}}
    <div class="min-w-0 flex-1">

        <div class="flex items-start justify-between gap-3">

            <div class="min-w-0">

                <div class="flex items-center gap-2">

                    <span
                        class="rounded-full {{ $config['color'] }} px-2 py-0.5 text-[10px] font-semibold">

                        {{ $config['badge'] }}

                    </span>

                    @if(!$notification->read_at)

                        <span
                            class="rounded-full bg-orange-500 px-2 py-0.5 text-[10px] font-bold text-white">

                            NEW

                        </span>

                    @endif

                </div>

                <h4
                    class="mt-2 truncate font-semibold text-sm text-gray-900 dark:text-white">

                    {{ $notification->data['title'] ?? 'Notification' }}

                </h4>

                <p
                    class="mt-1 line-clamp-2 text-sm text-gray-500 dark:text-gray-400">

                    {{ $notification->data['body'] ?? '' }}

                </p>

            </div>

            <div
                class="shrink-0 text-[11px] text-gray-400">

                {{ $notification->created_at->diffForHumans() }}

            </div>

        </div>

    </div>

</button>