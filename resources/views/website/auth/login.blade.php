@extends('website.layouts.auth')

@section('title', 'Sign In')

@section('content')

<div>

    <h2 class="text-4xl font-black text-slate-900">
        Welcome Back
    </h2>

    <p class="mt-3 text-slate-500">
        Sign in to your RealtyOS workspace.
    </p>
@if (session('status'))
    <div class="mt-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
        {{ session('status') }}
    </div>
@endif
    <form
        action="{{ route('login.store') }}"
        method="POST"
        novalidate
        class="mt-10 space-y-6">

        @csrf

        <!-- Email -->

        <div>

            <label
                for="email"
                class="mb-2 block font-medium text-slate-700">

                Work Email

            </label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                placeholder="you@company.com"
                autocomplete="email"
                class="w-full rounded-2xl border border-slate-300 px-5 py-4 outline-none transition focus:border-amber-500">

            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        <!-- Password -->

        <div>

            <div class="mb-2 flex items-center justify-between">

                <label
                    for="password"
                    class="font-medium text-slate-700">

                    Password

                </label>

                <a
                   href="{{ route('password.request') }}"
                    class="text-sm text-amber-500 hover:underline">

                    Forgot password?

                </a>

            </div>

            <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                class="w-full rounded-2xl border border-slate-300 px-5 py-4 outline-none transition focus:border-amber-500">

            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        <button
            type="submit"
            class="w-full rounded-2xl bg-amber-500 py-4 font-bold text-white transition hover:bg-amber-600">

            Sign In →

        </button>

    </form>

    <p class="mt-8 text-center text-slate-500">

        Don't have an account?

        <a
            href="{{ route('register') }}"
            class="font-semibold text-amber-500 hover:underline">

            Create Workspace

        </a>

    </p>

</div>

@endsection