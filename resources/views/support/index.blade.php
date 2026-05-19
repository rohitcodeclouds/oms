@extends('layouts.admin')

@section('title', 'Support')

@section('content')
    <div class="space-y-6">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-neutral-800 dark:text-white tracking-tight">Need Help?</h1>
                <p class="text-neutral-500 mt-1 text-sm">Get in touch with our support team or find answers.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Column: Contact Info & FAQs -->
            <div class="space-y-6">

                <!-- Contact Info -->
                <div class="glass p-6 sm:p-8 rounded-3xl relative overflow-hidden group">
                    <div
                        class="absolute -top-4 -right-4 w-24 h-24 bg-primary-500/5 rounded-full blur-2xl group-hover:bg-primary-500/10 transition-colors">
                    </div>
                    <h3 class="text-xl font-bold text-neutral-800 dark:text-white mb-6">Contact Information</h3>

                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-primary-100 dark:bg-primary-500/10 text-primary-500 rounded-xl shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-neutral-400 uppercase tracking-widest mb-1">Email Support
                                </p>
                                <a href="mailto:support@oms.com"
                                    class="text-sm font-semibold text-neutral-800 dark:text-white hover:text-primary-500 transition-colors">support@oms.com</a>
                                <p class="text-[10px] text-neutral-500 mt-1">Usually replies within 2 hours</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-blue-100 dark:bg-blue-500/10 text-blue-600 rounded-xl shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-neutral-400 uppercase tracking-widest mb-1">Phone Support
                                </p>
                                <a href="tel:+91XXXXXXXXXX"
                                    class="text-sm font-semibold text-neutral-800 dark:text-white hover:text-blue-500 transition-colors">+91
                                    XXXXXXXXXX</a>
                                <p class="text-[10px] text-neutral-500 mt-1">Mon-Fri, 9am - 6pm</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-emerald-100 dark:bg-emerald-500/10 text-emerald-600 rounded-xl shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-neutral-400 uppercase tracking-widest mb-1">Headquarters
                                </p>
                                <p class="text-sm font-semibold text-neutral-800 dark:text-white">OMS Building, Tech Park
                                </p>
                                <p class="text-[10px] text-neutral-500 mt-1">New Delhi, India</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Support Form -->
            <div class="lg:col-span-2 space-y-6">
                <div class="glass p-6 sm:p-8 rounded-3xl">
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-neutral-800 dark:text-white">Send us a message</h3>
                        <p class="text-[10px] text-neutral-400 uppercase tracking-widest mt-1">Submit a support ticket</p>
                    </div>

                    <form action="{{ route('support.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name"
                                    class="block text-xs font-bold text-neutral-500 uppercase tracking-widest mb-2">Your
                                    Name <span class="text-rose-500">*</span></label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', auth()->user() ? auth()->user()->name : '') }}" required
                                    class="w-full bg-black/5 dark:bg-white/5 border border-transparent rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:bg-white dark:focus:bg-neutral-900 transition-all dark:text-white">
                                @error('name')
                                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email"
                                    class="block text-xs font-bold text-neutral-500 uppercase tracking-widest mb-2">Email
                                    Address <span class="text-rose-500">*</span></label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', auth()->user() ? auth()->user()->email : '') }}" required
                                    class="w-full bg-black/5 dark:bg-white/5 border border-transparent rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:bg-white dark:focus:bg-neutral-900 transition-all dark:text-white">
                                @error('email')
                                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Subject -->
                        <div>
                            <label for="subject"
                                class="block text-xs font-bold text-neutral-500 uppercase tracking-widest mb-2">Subject
                                <span class="text-rose-500">*</span></label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                                class="w-full bg-black/5 dark:bg-white/5 border border-transparent rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:bg-white dark:focus:bg-neutral-900 transition-all dark:text-white">
                            @error('subject')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message"
                                class="block text-xs font-bold text-neutral-500 uppercase tracking-widest mb-2">Message
                                <span class="text-rose-500">*</span></label>
                            <textarea name="message" id="message" rows="5" required
                                class="w-full bg-black/5 dark:bg-white/5 border border-transparent rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:bg-white dark:focus:bg-neutral-900 transition-all dark:text-white resize-y">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-2 flex justify-end">
                            <button type="submit"
                                class="bg-primary-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-primary-600 hover:scale-[1.02] transition-all active:scale-95 shadow-lg shadow-primary-500/20 flex items-center space-x-2">
                                <span>Send Message</span>
                                <svg class="w-4 h-4 translate-y-px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>
@endsection