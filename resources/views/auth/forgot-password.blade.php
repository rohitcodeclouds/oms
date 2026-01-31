@extends('layouts.guest')

@section('title', 'Reset Password | OMS')

@section('content')
    <div
        class="glass w-full max-w-md p-8 rounded-2xl shadow-2xl border border-neutral-800/50 relative overflow-hidden group">

        <!-- Subtle sheen effect on hover -->
        <div
            class="absolute top-0 left-[-100%] w-full h-full bg-gradient-to-r from-transparent via-white/5 to-transparent transition-all duration-700 group-hover:left-[100%] pointer-events-none">
        </div>

        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold tracking-tight text-white mb-2">Forgot Password?</h2>
            <p class="text-neutral-400 text-sm">No worries, we'll send you reset instructions.</p>
        </div>

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <!-- Email Input -->
            <div class="space-y-2">
                <label for="email" class="text-xs font-medium text-neutral-400 uppercase tracking-wider ml-1">Email
                    Address</label>
                <div class="relative group/input">
                    <input type="email" name="email" id="email"
                        class="w-full bg-neutral-900/50 border border-neutral-700 rounded-xl px-4 py-3.5 text-neutral-200 placeholder-neutral-600 focus:outline-none focus:ring-2 focus:ring-neutral-500/50 focus:border-neutral-500 transition-all duration-300 shadow-inner"
                        placeholder="name@company.com" required autofocus>
                    <div
                        class="absolute inset-0 rounded-xl ring-1 ring-white/10 group-hover/input:ring-white/20 pointer-events-none transition-all">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full py-3.5 px-4 bg-gradient-to-br from-neutral-200 to-neutral-400 hover:from-white hover:to-neutral-300 text-neutral-900 font-bold rounded-xl shadow-[0_0_20px_-5px_rgba(255,255,255,0.2)] hover:shadow-[0_0_25px_-5px_rgba(255,255,255,0.3)] transform transition-all duration-200 hover:scale-[1.01] active:scale-[0.98] outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-500 focus:ring-offset-neutral-900">
                Send Reset Link
            </button>
        </form>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <a href="{{ route('login') }}"
                class="inline-flex items-center text-sm text-neutral-400 hover:text-white transition-colors group/link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="mr-2 transition-transform group-hover/link:-translate-x-1">
                    <path d="m15 18-6-6 6-6" />
                </svg>
                Back to Login
            </a>
        </div>
    </div>
@endsection