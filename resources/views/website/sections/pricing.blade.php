<section id="pricing" class="bg-white py-24">

    <div class="mx-auto max-w-7xl px-6">

        <div class="mx-auto max-w-3xl text-center">

            <span class="inline-flex rounded-full bg-amber-100 px-4 py-2 text-sm font-semibold text-amber-700">
                Pricing
            </span>

            <h2 class="mt-6 text-5xl font-black text-slate-900">
                Simple, Transparent Pricing
            </h2>

            <p class="mt-6 text-lg text-slate-600">
                Choose the perfect plan for your real estate business.
            </p>

        </div>

<div class="mt-20 grid gap-8 lg:grid-cols-3">

    @foreach ($plans as $plan)

        <div class="
            relative rounded-3xl p-10 shadow-sm transition hover:-translate-y-1

            {{ $plan->sort_order == 2
                ? 'border-2 border-amber-500 bg-slate-900 text-white shadow-2xl'
                : 'border border-slate-200 bg-white'
            }}
        ">

            @if($plan->sort_order == 2)
                <span
                    class="absolute -top-4 left-1/2 -translate-x-1/2 rounded-full bg-amber-500 px-5 py-2 text-sm font-bold text-white">
                    MOST POPULAR
                </span>
            @endif

            <h3 class="text-2xl font-bold">
                {{ $plan->name }}
            </h3>

            <p class="mt-4 {{ $plan->sort_order == 2 ? 'text-slate-300' : 'text-slate-500' }}">
                Perfect for your business.
            </p>

            <div class="mt-8">

                <span class="text-5xl font-black">
                    ${{ number_format($plan->price, 0) }}
                </span>

                <span class="{{ $plan->sort_order == 2 ? 'text-slate-300' : 'text-slate-500' }}">
                    /month
                </span>

            </div>

            <ul class="mt-8 space-y-4 {{ $plan->sort_order == 2 ? 'text-slate-300' : 'text-slate-600' }}">

                <li>✔ {{ $plan->max_users }} Users</li>

                <li>✔ {{ $plan->max_properties }} Properties</li>

                <li>✔ CRM & Leads</li>

                <li>✔ Reports</li>

                <li>✔ {{ $plan->trial_days }} Days Free Trial</li>

            </ul>

            <a
                href="{{ route('register', ['plan' => $plan->id]) }}"
                class="
                    mt-10 block rounded-2xl py-4 text-center font-bold transition

                    {{ $plan->sort_order == 2
                        ? 'bg-amber-500 text-white hover:bg-amber-600'
                        : 'border border-slate-300 hover:bg-slate-100'
                    }}
                "
            >
                Start Free Trial
            </a>

        </div>

    @endforeach

</div>

    </div>

</section>