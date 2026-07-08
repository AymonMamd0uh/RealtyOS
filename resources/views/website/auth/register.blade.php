@extends('website.layouts.auth')

@section('title', 'Create Workspace')

@section('content')

<div>

    <h2 class="text-4xl font-black text-slate-900">
        Create Your Workspace
    </h2>

    <p class="mt-3 text-slate-500">
        Start your free trial in less than a minute.
    </p>
    @if($plan)
    <div class="mb-6 rounded-2xl border border-amber-200 bg-amber-50 p-4">
        <p class="font-semibold text-amber-700">
            Selected Plan: {{ $plan->name }}
        </p>
        <p class="mt-1 text-sm text-slate-600">
            ${{ number_format($plan->price, 0) }}/month •
            {{ $plan->trial_days }} Days Free Trial
        </p>
    </div>
@endif
  <form
    action="{{ route('register.store') }}"
    method="POST"
    novalidate
    class="mt-10 space-y-6">

    @csrf
    <input
    type="hidden"
    name="plan_id"
    value="{{ $plan?->id }}">
    <!-- Company Name -->
    <div>

        <label
            for="company_name"
            class="mb-2 block font-medium text-slate-700">

            Company Name

        </label>

        <input
            id="company_name"
            name="company_name"
            type="text"
            value="{{ old('company_name') }}"
            placeholder="Acme Real Estate"
            autocomplete="organization"
            class="w-full rounded-2xl border px-5 py-4 outline-none transition
            @error('company_name')
                border-red-500
            @else
                border-slate-300 focus:border-amber-500
            @enderror">

        @error('company_name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror

    </div>

    <!-- Owner Name -->
    <div>

        <label
            for="owner_name"
            class="mb-2 block font-medium text-slate-700">

            Owner Name

        </label>

        <input
            id="owner_name"
            name="owner_name"
            type="text"
            value="{{ old('owner_name') }}"
            placeholder="John Doe"
            autocomplete="name"
            class="w-full rounded-2xl border px-5 py-4 outline-none transition
            @error('owner_name')
                border-red-500
            @else
                border-slate-300 focus:border-amber-500
            @enderror">

        @error('owner_name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror

    </div>

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
            class="w-full rounded-2xl border px-5 py-4 outline-none transition
            @error('email')
                border-red-500
            @else
                border-slate-300 focus:border-amber-500
            @enderror">

        @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror

    </div>

    <!-- Password -->
    <div>

        <label
            for="password"
            class="mb-2 block font-medium text-slate-700">

            Password

        </label>

        <input
            id="password"
            name="password"
            type="password"
            autocomplete="new-password"
            placeholder="••••••••"
            class="w-full rounded-2xl border px-5 py-4 outline-none transition
            @error('password')
                border-red-500
            @else
                border-slate-300 focus:border-amber-500
            @enderror">

        @error('password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror

    </div>

    <!-- Confirm Password -->
    <div>

        <label
            for="password_confirmation"
            class="mb-2 block font-medium text-slate-700">

            Confirm Password

        </label>

        <input
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            autocomplete="new-password"
            placeholder="••••••••"
            class="w-full rounded-2xl border border-slate-300 px-5 py-4 outline-none transition focus:border-amber-500">

    </div>

    <button
        type="submit"
        class="w-full rounded-2xl bg-amber-500 py-4 font-bold text-white transition hover:bg-amber-600">

        Create Workspace →

    </button>

</form>

    <p class="mt-8 text-center text-slate-500">

        Already have an account?

        <a
            href="{{ route('login') }}"
            class="font-semibold text-amber-500 hover:underline">

            Sign In

        </a>

    </p>

</div>

@endsection