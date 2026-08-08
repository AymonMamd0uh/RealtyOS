<div class="mx-auto max-w-7xl space-y-6">

    {{-- Header --}}
    @include('livewire.notifications.header')

    {{-- Toolbar (Search + Filters) --}}
    @include('livewire.notifications.toolbar')

    {{-- Notifications --}}
    <div class="space-y-4">

        @forelse($notifications as $notification)

            @include(
                'livewire.notifications.card',
                ['notification' => $notification]
            )

        @empty

            @include('livewire.notifications.empty')

        @endforelse

    </div>

    {{-- Pagination --}}
    @if($notifications->hasPages())

        <div class="pt-2">

            {{ $notifications->links() }}

        </div>

    @endif

</div>