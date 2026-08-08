@extends('website.layouts.auth')

@section('content')

<div class="max-w-md mx-auto mt-20 bg-white rounded-xl shadow p-8">

    <h1 class="text-2xl font-bold mb-4">
        Verify your email
    </h1>

    <p class="text-gray-600 mb-6">
        Thanks for registering.

        Before accessing your dashboard, please verify your email address.

        We've already sent a verification link to:

        <strong>{{ auth()->user()->email }}</strong>
    </p>

    @if (session('status'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button
            class="w-full bg-amber-500 text-white py-3 rounded-lg">
            Resend Verification Email
        </button>
    </form>

    <form
        class="mt-4"
        method="POST"
        action="{{ route('logout') }}">

        @csrf

        <button class="text-red-600">
            Logout
        </button>

    </form>

</div>

@endsection