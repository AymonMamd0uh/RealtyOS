<x-filament-panels::page>

    <div class="grid gap-6 xl:grid-cols-3">

        {{-- Current Subscription --}}
        <x-filament::section>

            <x-slot name="heading">
                Current Subscription
            </x-slot>

            <x-slot name="description">
                Your active subscription details.
            </x-slot>

            <div class="space-y-5">

                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">
                        Plan
                    </span>

                    <span class="rounded-lg bg-primary-50 px-3 py-1 text-sm font-semibold text-primary-600">
                        {{ $currentPlan?->name ?? 'No Plan' }}
                    </span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">
                        Status
                    </span>

                    <span @class([
                        'rounded-lg px-3 py-1 text-sm font-semibold',
                        'bg-success-100 text-success-700' => $subscription?->status === 'active',
                        'bg-danger-100 text-danger-700' => $subscription?->status !== 'active',
                    ])>
                        {{ ucfirst($subscription?->status ?? 'Inactive') }}
                    </span>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">
                        Trial Ends
                    </span>

                    <strong>
                        {{ $subscription?->trial_ends_at?->format('d M Y') ?? 'Lifetime' }}
                    </strong>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">
                        Days Remaining
                    </span>

                    <strong class="text-lg">
                        {{ $daysRemaining }}
                    </strong>
                </div>

            </div>

        </x-filament::section>

        {{-- Usage --}}
        <x-filament::section>

            <x-slot name="heading">
                Resource Usage
            </x-slot>

            <x-slot name="description">
                Current usage for your subscription.
            </x-slot>

            <div class="space-y-8">

                <div>

                    <div class="mb-2 flex items-center justify-between">

                        <span class="font-medium">
                            Users
                        </span>

                        <strong>

                            {{ $usersCount }}

                            /

                            {{ $currentPlan?->max_users == -1 ? 'Unlimited' : $currentPlan?->max_users }}

                        </strong>

                    </div>

                    <progress
                        class="progress progress-primary w-full"
                        value="{{ $usersCount }}"
                        max="{{ $currentPlan?->max_users == -1 ? max($usersCount,1) : $currentPlan?->max_users }}">
                    </progress>

                </div>

                <div>

                    <div class="mb-2 flex items-center justify-between">

                        <span class="font-medium">
                            Properties
                        </span>

                        <strong>

                            {{ $propertiesCount }}

                            /

                            {{ $currentPlan?->max_properties == -1 ? 'Unlimited' : $currentPlan?->max_properties }}

                        </strong>

                    </div>

                    <progress
                        class="progress progress-warning w-full"
                        value="{{ $propertiesCount }}"
                        max="{{ $currentPlan?->max_properties == -1 ? max($propertiesCount,1) : $currentPlan?->max_properties }}">
                    </progress>

                </div>

            </div>

        </x-filament::section>

        {{-- Plans --}}
        <x-filament::section>

            <x-slot name="heading">
                Available Plans
            </x-slot>

            <x-slot name="description">
                Upgrade or change your subscription.
            </x-slot>

            <div class="space-y-4">

                @foreach($this->plans() as $plan)

                    <div class="rounded-xl border p-5 transition hover:shadow-lg">

                        <div class="flex items-start justify-between">

                            <div>

                                <h3 class="text-lg font-bold">
                                    {{ $plan->name }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $plan->trial_days }} Days Free Trial
                                </p>

                            </div>

                            <div class="text-right">

                                <div class="text-2xl font-bold">
                                    ${{ number_format($plan->price,0) }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    / Month
                                </div>

                            </div>

                        </div>

                        <div class="mt-5 space-y-2 text-sm">

                            <div>
                                👥
                                {{ $plan->max_users == -1 ? 'Unlimited Users' : $plan->max_users.' Users' }}
                            </div>

                            <div>
                                🏠
                                {{ $plan->max_properties == -1 ? 'Unlimited Properties' : $plan->max_properties.' Properties' }}
                            </div>

                        </div>

                        @if($currentPlan?->id != $plan->id)

                            <form
                                method="POST"
                                action="{{ route('subscription.checkout') }}"
                                class="mt-5">

                                @csrf

                                <input
                                    type="hidden"
                                    name="plan"
                                    value="{{ $plan->id }}">

                                <x-filament::button
                                    type="submit"
                                    color="primary"
                                    class="w-full">

                                    Upgrade Plan

                                </x-filament::button>

                            </form>

                        @else

                            <x-filament::badge
                                color="success"
                                class="mt-5">

                                Current Plan

                            </x-filament::badge>

                        @endif

                    </div>

                @endforeach

            </div>

        </x-filament::section>

    </div>

</x-filament-panels::page>