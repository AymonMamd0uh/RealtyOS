@extends('website.layouts.app')

@section('content')

<div class="mx-auto max-w-3xl py-24 text-center">

    <h1 class="text-5xl font-bold text-red-600">
        Subscription Expired
    </h1>

    <p class="mt-6 text-lg text-gray-600">
        Your trial or subscription has expired.
    </p>

    <p class="mt-2 text-gray-500">
        Upgrade your plan to continue using RealtyOS.
    </p>

    <a href="#"
       class="mt-10 inline-flex rounded-xl bg-amber-500 px-8 py-4 font-semibold text-white">
        Upgrade Now
    </a>

</div>

@endsection