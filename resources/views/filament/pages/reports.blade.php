<x-filament-panels::page>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="rounded-xl bg-white p-6 shadow">
            <h3 class="text-sm text-gray-500">Total Leads</h3>
            <p class="text-3xl font-bold">{{ $this->totalLeads }}</p>
        </div>

        <div class="rounded-xl bg-white p-6 shadow">
            <h3 class="text-sm text-gray-500">Won Leads</h3>
            <p class="text-3xl font-bold">{{ $this->wonLeads }}</p>
        </div>

        <div class="rounded-xl bg-white p-6 shadow">
            <h3 class="text-sm text-gray-500">Lost Leads</h3>
            <p class="text-3xl font-bold">{{ $this->lostLeads }}</p>
        </div>

        <div class="rounded-xl bg-white p-6 shadow">
            <h3 class="text-sm text-gray-500">Conversion Rate</h3>
            <p class="text-3xl font-bold">{{ $this->conversionRate }}%</p>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">

        <div class="rounded-xl bg-white p-6 shadow">
            <h3 class="text-sm text-gray-500">Total Properties</h3>
            <p class="text-3xl font-bold">{{ $this->totalProperties }}</p>
        </div>

        <div class="rounded-xl bg-white p-6 shadow">
            <h3 class="text-sm text-gray-500">Available Properties</h3>
            <p class="text-3xl font-bold">{{ $this->availableProperties }}</p>
        </div>

        <div class="rounded-xl bg-white p-6 shadow">
            <h3 class="text-sm text-gray-500">Sold Properties</h3>
            <p class="text-3xl font-bold">{{ $this->soldProperties }}</p>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-6">

        <div class="rounded-xl bg-white p-6 shadow">
            <h3 class="text-sm text-gray-500">Total Agents</h3>
            <p class="text-3xl font-bold">{{ $this->totalAgents }}</p>
        </div>

    </div>

</x-filament-panels::page>