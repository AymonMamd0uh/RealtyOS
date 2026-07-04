<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'RealtyOS')</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="min-h-screen bg-slate-50">

    <div class="flex min-h-screen">

        <!-- Left -->

        <div class="hidden lg:flex lg:w-1/2 bg-slate-900 text-white">

            <div class="m-auto max-w-md px-10">

                <a href="{{ route('home') }}"
                    class="text-4xl font-black">

                    Realty<span class="text-amber-500">OS</span>

                </a>

                <h1 class="mt-10 text-5xl font-black leading-tight">

                    Build Your
                    Real Estate
                    Company.

                </h1>

                <p class="mt-8 text-lg leading-8 text-slate-300">

                    Manage properties, leads, brokers, follow-ups,
                    reports and sales from one powerful platform.

                </p>

            </div>

        </div>

        <!-- Right -->

        <div class="flex w-full items-center justify-center bg-white lg:w-1/2">

            <div class="w-full max-w-md px-8">

                @yield('content')

            </div>

        </div>

    </div>

</body>

</html>