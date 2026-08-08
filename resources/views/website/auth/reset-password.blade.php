@extends('website.layouts.auth')

@section('title', 'Reset Password')

@section('content')

<div>

    <h2 class="text-4xl font-black text-slate-900">
        Reset Password
    </h2>

    <p class="mt-3 text-slate-500">
        Enter your new password below.
    </p>

    <form
        action="{{ route('password.update') }}"
        method="POST"
        class="mt-10 space-y-6">

        @csrf

        <input
            type="hidden"
            name="token"
            value="{{ $token }}">

        <div>

            <label
                for="email"
                class="mb-2 block font-medium">

                Email

            </label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', request('email')) }}"
                required
                autocomplete="email"
                class="w-full rounded-2xl border border-slate-300 px-5 py-4 outline-none transition focus:border-amber-500">

            @error('email')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <div>

            <label
                for="password"
                class="mb-2 block font-medium">

                New Password

            </label>

            <input
                id="password"
                name="password"
                type="password"
                required
                autocomplete="new-password"
                class="w-full rounded-2xl border border-slate-300 px-5 py-4 outline-none transition focus:border-amber-500">

            @error('password')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <div>

            <label
                for="password_confirmation"
                class="mb-2 block font-medium">

                Confirm Password

            </label>

            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                required
                autocomplete="new-password"
                class="w-full rounded-2xl border border-slate-300 px-5 py-4 outline-none transition focus:border-amber-500">

        </div>

        <button
            type="submit"
            class="w-full rounded-2xl bg-amber-500 py-4 font-bold text-white transition hover:bg-amber-600">

            Reset Password →

        </button>

    </form>

</div>

@endsection