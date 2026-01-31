@extends('layouts.guest')

@section('title', 'Sign In | OMS')

@section('content')
    <div
        class="glass w-full max-w-md p-8 rounded-2xl shadow-2xl border border-neutral-800/50 relative overflow-hidden group">

        <!-- Subtle sheen effect on hover -->
        <div
            class="absolute top-0 left-[-100%] w-full h-full bg-gradient-to-r from-transparent via-white/5 to-transparent transition-all duration-700 group-hover:left-[100%] pointer-events-none">
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold tracking-tight text-white mb-2">Welcome Back</h2>
            <p class="text-neutral-400 text-sm">Sign in to access your dashboard</p>
        </div>

        <form method="POST" action="/login" class="space-y-6">
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

            <!-- Password Input -->
            <div class="space-y-2">
                <div class="flex items-center justify-between ml-1">
                    <label for="password"
                        class="text-xs font-medium text-neutral-400 uppercase tracking-wider">Password</label>
                    @if (Route::has('forgot-password'))
                        <a href="{{ route('forgot-password') }}"
                            class="text-xs text-neutral-400 hover:text-white transition-colors">Forgot password?</a>
                    @endif
                </div>
                <div class="relative group/input">
                    <input type="password" name="password" id="password"
                        class="w-full bg-neutral-900/50 border border-neutral-700 rounded-xl px-4 py-3.5 text-neutral-200 placeholder-neutral-600 focus:outline-none focus:ring-2 focus:ring-neutral-500/50 focus:border-neutral-500 transition-all duration-300 shadow-inner"
                        placeholder="••••••••" required>
                    <div
                        class="absolute inset-0 rounded-xl ring-1 ring-white/10 group-hover/input:ring-white/20 pointer-events-none transition-all">
                    </div>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    class="w-4 h-4 text-neutral-600 border-neutral-700 rounded bg-neutral-800 focus:ring-offset-0 focus:ring-neutral-500 cursor-pointer">
                <label for="remember_me"
                    class="ml-2 block text-sm text-neutral-400 cursor-pointer select-none hover:text-neutral-300 transition-colors">
                    Remember me for 30 days
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full py-3.5 px-4 bg-gradient-to-br from-neutral-200 to-neutral-400 hover:from-white hover:to-neutral-300 text-neutral-900 font-bold rounded-xl shadow-[0_0_20px_-5px_rgba(255,255,255,0.2)] hover:shadow-[0_0_25px_-5px_rgba(255,255,255,0.3)] transform transition-all duration-200 hover:scale-[1.01] active:scale-[0.98] outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-500 focus:ring-offset-neutral-900">
                Sign In
            </button>
        </form>

        <!-- Divider -->
        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-neutral-800"></div>
            </div>
            <div class="relative flex justify-center text-xs uppercase">
                <span class="bg-neutral-900/0 px-4 text-neutral-500 backdrop-blur-sm">Or continue with</span>
            </div>
        </div>

        <!-- Social Logins -->
        <div class="grid grid-cols-2 gap-4">
            <a href="javascript:void(0)"
                class="flex items-center justify-center py-2.5 px-4 bg-white/5 border border-neutral-800 rounded-xl hover:bg-white/10 transition-all duration-200 group">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                        fill="#4285F4" />
                    <path
                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                        fill="#34A853" />
                    <path
                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                        fill="#FBBC05" />
                    <path
                        d="M12 5.38c1.62 0 3.06.56 4.21 1.66l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                        fill="#EA4335" />
                </svg>
                <span class="text-sm font-medium text-neutral-300 group-hover:text-white">Google</span>
            </a>
            <a href="javascript:void(0)"
                class="flex items-center justify-center py-2.5 px-4 bg-white/5 border border-neutral-800 rounded-xl hover:bg-white/10 transition-all duration-200 group">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
                </svg>
                <span class="text-sm font-medium text-neutral-300 group-hover:text-white">Github</span>
            </a>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-sm text-neutral-500">
                Don't have an account?
                <a href="{{ route('register') }}"
                    class="text-neutral-300 font-medium hover:text-white hover:underline transition-all decoration-neutral-500 underline-offset-4">Create
                    account</a>
            </p>
        </div>
    </div>
@endsection