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
                value="{{ request('email') }}"
                class="w-full rounded-2xl border border-slate-300 px-5 py-4">

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
                class="w-full rounded-2xl border border-slate-300 px-5 py-4">

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
                class="w-full rounded-2xl border border-slate-300 px-5 py-4">

        </div>

        <button
            type="submit"
            class="w-full rounded-2xl bg-amber-500 py-4 font-bold text-white">

            Reset Password →

        </button>

    </form>

</div>

@endsection