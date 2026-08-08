@props(['notification'])

@php
    $type = $notification->data['type'] ?? 'system';

    $badge = match ($type) {
        'lead_assigned' => [
            'icon' => '👤',
            'label' => 'Lead',
            'color' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
        ],

        'follow_up' => [
            'icon' => '📅',
            'label' => 'Follow Up',
            'color' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300',
        ],

        'property' => [
            'icon' => '🏠',
            'label' => 'Property',
            'color' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
        ],

        'subscription' => [
            'icon' => '💳',
            'label' => 'Subscription',
            'color' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300',
        ],

        default => [
            'icon' => '🔔',
            'label' => 'System',
            'color' => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300',
        ],
    };
@endphp

<div
    class="overflow-hidden rounded-2xl border transition-all duration-200

    {{ $notification->read_at
        ? 'border-gray-200 bg-white hover:border-orange-300 hover:shadow-md dark:border-gray-700 dark:bg-gray-900'
        : 'border-orange-300 bg-orange-50/70 shadow-sm hover:shadow-lg dark:border-orange-700 dark:bg-orange-900/10' }}">

    <button
        wire:click="openNotification('{{ $notification->id }}')"
        class="w-full text-left">

        <div class="flex gap-4 p-5">

            {{-- Status Dot --}}
            <div class="pt-1">

                <div
                    class="h-3 w-3 rounded-full

                    {{ $notification->read_at
                        ? 'bg-gray-300'
                        : 'bg-orange-500 animate-pulse' }}">
                </div>

            </div>

            {{-- Content --}}
            <div class="min-w-0 flex-1">

                {{-- Top --}}
                <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">

                    <div class="space-y-3">

                        {{-- Badge --}}
                        <span
                            class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold {{ $badge['color'] }}">

                            <span>{{ $badge['icon'] }}</span>

                            <span>{{ $badge['label'] }}</span>

                        </span>

                        {{-- Title --}}
                        <h3 class="text-base font-semibold text-gray-900 dark:text-white">

                            {{ $notification->data['title'] }}

                        </h3>

                        {{-- Body --}}
                        <p class="text-sm leading-6 text-gray-600 dark:text-gray-400">

                            {{ $notification->data['body'] }}

                        </p>

                    </div>

                    {{-- Time --}}
                    <div
                        class="shrink-0 text-xs text-gray-400">

                        {{ $notification->created_at->diffForHumans() }}

                    </div>

                </div>

            </div>

        </div>

    </button>

    {{-- Actions --}}
    @include(
        'livewire.notifications.card-actions',
        ['notification' => $notification]
    )

</div>