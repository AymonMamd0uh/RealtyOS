<section id="faq" class="bg-slate-50 py-24">

    <div class="mx-auto max-w-5xl px-6">

        <div class="mx-auto max-w-3xl text-center">

            <span class="inline-flex rounded-full bg-amber-100 px-4 py-2 text-sm font-semibold text-amber-700">
                FAQ
            </span>

            <h2 class="mt-6 text-5xl font-black text-slate-900">
                Frequently Asked Questions
            </h2>

            <p class="mt-6 text-lg text-slate-600">
                Everything you need to know before getting started.
            </p>

        </div>

        <div class="mt-20 space-y-4">

            @foreach ([
                ['q' => 'Can I try RealtyOS for free?', 'a' => 'Yes. Every new account starts with a free trial.'],
                ['q' => 'Can I invite my team?', 'a' => 'Yes. Invite managers, brokers and employees with custom roles.'],
                ['q' => 'Is my company data secure?', 'a' => 'Absolutely. Every company has its own isolated workspace.'],
                ['q' => 'Can I manage unlimited properties?', 'a' => 'Depending on your subscription plan, you can manage thousands of properties.'],
                ['q' => 'Does RealtyOS support mobile?', 'a' => 'Yes. RealtyOS is fully responsive and works perfectly on phones and tablets.'],
            ] as $faq)

                <div
                    x-data="{ open: false }"
                    class="rounded-2xl border border-slate-200 bg-white">

                    <button
                        @click="open = !open"
                        class="flex w-full items-center justify-between px-8 py-6 text-left">

                        <span class="text-lg font-semibold">

                            {{ $faq['q'] }}

                        </span>

                        <span
                            class="text-2xl font-bold"
                            x-text="open ? '−' : '+'">

                        </span>

                    </button>

                    <div
                        x-show="open"
                        x-transition
                        class="px-8 pb-6 text-slate-600">

                        {{ $faq['a'] }}

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>