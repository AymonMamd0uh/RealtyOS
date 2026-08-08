<x-filament-widgets::widget>
    <x-filament::section>

        <x-slot name="heading">
            Quick Actions
        </x-slot>

        <x-slot name="description">
            Frequently used shortcuts
        </x-slot>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

            <a
                href="{{ \App\Filament\Resources\Properties\PropertyResource::getUrl('create') }}"
                class="flex items-center gap-3 rounded-xl border p-4 transition hover:bg-gray-50 dark:hover:bg-white/5">

                <x-heroicon-o-home class="h-8 w-8 text-primary-600" />

                <div>
                    <div class="font-semibold">
                        Add Property
                    </div>

                    <div class="text-sm text-gray-500">
                        Create a new property
                    </div>
                </div>

            </a>

            <a
                href="{{ \App\Filament\Resources\Leads\LeadResource::getUrl('create') }}"
                class="flex items-center gap-3 rounded-xl border p-4 transition hover:bg-gray-50 dark:hover:bg-white/5">

                <x-heroicon-o-user-plus class="h-8 w-8 text-success-600" />

                <div>
                    <div class="font-semibold">
                        Add Lead
                    </div>

                    <div class="text-sm text-gray-500">
                        Register a new lead
                    </div>
                </div>

            </a>

            <a
                href="{{ \App\Filament\Resources\Properties\PropertyResource::getUrl('index') }}"
                class="flex items-center gap-3 rounded-xl border p-4 transition hover:bg-gray-50 dark:hover:bg-white/5">

                <x-heroicon-o-building-office-2 class="h-8 w-8 text-warning-600" />

                <div>
                    <div class="font-semibold">
                        My Properties
                    </div>

                    <div class="text-sm text-gray-500">
                        Browse all properties
                    </div>
                </div>

            </a>

            <a
                href="{{ \App\Filament\Resources\Leads\LeadResource::getUrl('index') }}"
                class="flex items-center gap-3 rounded-xl border p-4 transition hover:bg-gray-50 dark:hover:bg-white/5">

                <x-heroicon-o-phone class="h-8 w-8 text-danger-600" />

                <div>
                    <div class="font-semibold">
                        My Leads
                    </div>

                    <div class="text-sm text-gray-500">
                        View assigned leads
                    </div>
                </div>

            </a>

        </div>

    </x-filament::section>
</x-filament-widgets::widget>