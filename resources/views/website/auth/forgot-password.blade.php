@extends('website.layouts.auth')

@section('title', 'Forgot Password')

@section('content')

<div>

    <h2 class="text-4xl font-black text-slate-900">

        Forgot Password

    </h2>

    <p class="mt-3 text-slate-500">

        Enter your email address and we'll send you a password reset link.

    </p>
@if (session('status'))
    <div class="mt-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
        {{ session('status') }}
    </div>
@endif
    <form
        action="{{ route('password.email') }}"
        method="POST"
        class="mt-10 space-y-6">

        @csrf

        <div>

            <label
                for="email"
                class="mb-2 block font-medium">

                Work Email

            </label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                class="w-full rounded-2xl border border-slate-300 px-5 py-4 outline-none transition focus:border-amber-500">

        </div>

        <button
            type="submit"
            class="w-full rounded-2xl bg-amber-500 py-4 font-bold text-white transition hover:bg-amber-600">

            Send Reset Link →

        </button>

    </form>

    <p class="mt-8 text-center text-slate-500">

        Remember your password?

        <a
            href="{{ route('login') }}"
            class="font-semibold text-amber-500 hover:underline">

            Sign In

        </a>

    </p>

</div>

@endsection