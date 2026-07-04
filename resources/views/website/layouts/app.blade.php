<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'RealtyOS')
    </title>

    <meta
        name="description"
        content="Modern CRM for Real Estate Companies">

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="bg-slate-50 text-slate-900 antialiased">

    @include('website.components.navbar')

    <main>

        @yield('content')

    </main>

    @include('website.components.footer')

</body>

</html>