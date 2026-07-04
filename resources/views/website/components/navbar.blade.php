<nav class="sticky top-0 z-50 border-b border-slate-200 bg-white/80 backdrop-blur">

    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">

        <a
            href="{{ route('home') }}"
            class="text-3xl font-black tracking-tight">

            Realty<span class="text-amber-500">OS</span>

        </a>

        <div class="hidden items-center gap-10 md:flex">

            <a href="#features"
                class="text-slate-600 transition hover:text-amber-500">

                Features

            </a>

            <a href="#pricing"
                class="text-slate-600 transition hover:text-amber-500">

                Pricing

            </a>

            <a href="#faq"
                class="text-slate-600 transition hover:text-amber-500">

                FAQ

            </a>



        </div>

        <div class="flex items-center gap-3">

            <a
                href="{{ route('login') }}"
                class="rounded-xl px-5 py-2 font-medium transition hover:bg-slate-100">

                Login

            </a>

            <a
                href="{{ route('register') }}"
                class="rounded-xl bg-amber-500 px-5 py-3 font-semibold text-white shadow transition hover:bg-amber-600">

                Start Free Trial →

            </a>

        </div>

    </div>

</nav>