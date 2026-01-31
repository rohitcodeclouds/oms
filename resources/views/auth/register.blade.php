@extends('layouts.guest')

@section('title', 'Create Account | OMS')

@section('content')
    <div
        class="glass w-full max-w-md p-8 rounded-2xl shadow-2xl border border-neutral-800/50 relative overflow-hidden group">

        <!-- Subtle sheen effect on hover -->
        <div
            class="absolute top-0 left-[-100%] w-full h-full bg-gradient-to-r from-transparent via-white/5 to-transparent transition-all duration-700 group-hover:left-[100%] pointer-events-none">
        </div>

        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold tracking-tight text-white mb-2">Create Account</h2>
            <p class="text-neutral-400 text-sm">Join us and start managing your orders</p>
        </div>

        <form method="POST" action="/register" class="space-y-5">
            @csrf

            <!-- Name Input -->
            <div class="space-y-1.5">
                <label for="name" class="text-xs font-medium text-neutral-400 uppercase tracking-wider ml-1">Full
                    Name</label>
                <div class="relative group/input">
                    <input type="text" name="name" id="name"
                        class="w-full bg-neutral-900/50 border border-neutral-700 rounded-xl px-4 py-3 text-neutral-200 placeholder-neutral-600 focus:outline-none focus:ring-2 focus:ring-neutral-500/50 focus:border-neutral-500 transition-all duration-300 shadow-inner"
                        placeholder="John Doe" required autofocus>
                    <div
                        class="absolute inset-0 rounded-xl ring-1 ring-white/10 group-hover/input:ring-white/20 pointer-events-none transition-all">
                    </div>
                </div>
            </div>

            <!-- Email Input -->
            <div class="space-y-1.5">
                <label for="email" class="text-xs font-medium text-neutral-400 uppercase tracking-wider ml-1">Email
                    Address</label>
                <div class="relative group/input">
                    <input type="email" name="email" id="email"
                        class="w-full bg-neutral-900/50 border border-neutral-700 rounded-xl px-4 py-3 text-neutral-200 placeholder-neutral-600 focus:outline-none focus:ring-2 focus:ring-neutral-500/50 focus:border-neutral-500 transition-all duration-300 shadow-inner"
                        placeholder="name@company.com" required>
                    <div
                        class="absolute inset-0 rounded-xl ring-1 ring-white/10 group-hover/input:ring-white/20 pointer-events-none transition-all">
                    </div>
                </div>
            </div>

            <!-- Password Input -->
            <div class="space-y-1.5">
                <label for="password"
                    class="text-xs font-medium text-neutral-400 uppercase tracking-wider ml-1">Password</label>
                <div class="relative group/input">
                    <input type="password" name="password" id="password"
                        class="w-full bg-neutral-900/50 border border-neutral-700 rounded-xl px-4 py-3 text-neutral-200 placeholder-neutral-600 focus:outline-none focus:ring-2 focus:ring-neutral-500/50 focus:border-neutral-500 transition-all duration-300 shadow-inner"
                        placeholder="••••••••" required>
                    <div
                        class="absolute inset-0 rounded-xl ring-1 ring-white/10 group-hover/input:ring-white/20 pointer-events-none transition-all">
                    </div>
                </div>
            </div>

            <!-- Confirm Password Input -->
            <div class="space-y-1.5">
                <label for="password_confirmation"
                    class="text-xs font-medium text-neutral-400 uppercase tracking-wider ml-1">Confirm Password</label>
                <div class="relative group/input">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full bg-neutral-900/50 border border-neutral-700 rounded-xl px-4 py-3 text-neutral-200 placeholder-neutral-600 focus:outline-none focus:ring-2 focus:ring-neutral-500/50 focus:border-neutral-500 transition-all duration-300 shadow-inner"
                        placeholder="••••••••" required>
                    <div
                        class="absolute inset-0 rounded-xl ring-1 ring-white/10 group-hover/input:ring-white/20 pointer-events-none transition-all">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full py-3.5 px-4 mt-2 bg-gradient-to-br from-neutral-200 to-neutral-400 hover:from-white hover:to-neutral-300 text-neutral-900 font-bold rounded-xl shadow-[0_0_20px_-5px_rgba(255,255,255,0.2)] hover:shadow-[0_0_25px_-5px_rgba(255,255,255,0.3)] transform transition-all duration-200 hover:scale-[1.01] active:scale-[0.98] outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-500 focus:ring-offset-neutral-900">
                Create Account
            </button>
        </form>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-sm text-neutral-500">
                Already have an account?
                <a href="{{ route('login') }}"
                    class="text-neutral-300 font-medium hover:text-white hover:underline transition-all decoration-neutral-500 underline-offset-4">Sign
                    in</a>
            </p>
        </div>
    </div>
@endsection