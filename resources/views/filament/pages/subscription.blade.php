<x-filament-panels::page>

    <div class="grid gap-6 lg:grid-cols-3">

        {{-- Current Plan --}}
        <x-filament::section>

            <x-slot name="heading">
                Current Subscription
            </x-slot>

            <div class="space-y-4">

                <div class="flex justify-between">
                    <span class="text-gray-500">Current Plan</span>
                    <strong>{{ $currentPlan?->name }}</strong>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Status</span>

                    <span class="font-semibold text-success-600">
                        {{ ucfirst($subscription?->status) }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Trial Ends</span>

                    <strong>

                        {{ $subscription?->trial_ends_at?->format('d M Y') }}

                    </strong>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">

                        Days Remaining

                    </span>

                    <strong>

                        {{ $daysRemaining }}

                    </strong>
                </div>

            </div>

        </x-filament::section>

        {{-- Usage --}}
        <x-filament::section>

            <x-slot name="heading">
                Usage
            </x-slot>

            <div class="space-y-6">

                <div>

                    <div class="mb-2 flex justify-between">

                        <span>Users</span>

                        <strong>

                            {{ $usersCount }}

                            /

                            {{ $currentPlan?->max_users == -1 ? '∞' : $currentPlan?->max_users }}

                        </strong>

                    </div>

                    <progress
                        class="w-full"
                        value="{{ $usersCount }}"
                        max="{{ $currentPlan?->max_users == -1 ? 1 : $currentPlan?->max_users }}">
                    </progress>

                </div>

                <div>

                    <div class="mb-2 flex justify-between">

                        <span>Properties</span>

                        <strong>

                            {{ $propertiesCount }}

                            /

                            {{ $currentPlan?->max_properties == -1 ? '∞' : $currentPlan?->max_properties }}

                        </strong>

                    </div>

                    <progress
                        class="w-full"
                        value="{{ $propertiesCount }}"
                        max="{{ $currentPlan?->max_properties == -1 ? 1 : $currentPlan?->max_properties }}">
                    </progress>

                </div>

            </div>

        </x-filament::section>

        {{-- Plans --}}
        <x-filament::section>

            <x-slot name="heading">
                Available Plans
            </x-slot>

            <div class="space-y-4">

                @foreach($this->plans() as $plan)

                    <div class="rounded-xl border p-4">

                        <div class="flex items-center justify-between">

                            <h3 class="font-bold">

                                {{ $plan->name }}

                            </h3>

                            <span class="text-lg font-bold">

                                ${{ number_format($plan->price,0) }}

                            </span>

                        </div>

                        <div class="mt-3 space-y-1 text-sm text-gray-600">

                            <div>

                                {{ $plan->max_users == -1 ? 'Unlimited Users' : $plan->max_users.' Users' }}

                            </div>

                            <div>

                                {{ $plan->max_properties == -1 ? 'Unlimited Properties' : $plan->max_properties.' Properties' }}

                            </div>

                            <div>

                                {{ $plan->trial_days }} Days Trial

                            </div>

                        </div>

                        @if($currentPlan?->id != $plan->id)
                        <form
                            method="POST"
                            action="{{ route('subscription.checkout') }}">

                            @csrf

                            <input
                                type="hidden"
                                name="plan"
                                value="{{ $plan->id }}">

                            <button
                                type="submit"
                                class="mt-4 w-full rounded-lg bg-amber-500 py-2 text-white">

                                Upgrade

                            </button>

                        </form>
                        @else

                            <div class="mt-4 rounded-lg bg-green-100 py-2 text-center font-semibold text-green-700">

                                Current Plan

                            </div>

                        @endif

                    </div>

                @endforeach

            </div>

        </x-filament::section>

    </div>

</x-filament-panels::page>