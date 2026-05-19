@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
    <div class="space-y-6">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-neutral-800 dark:text-white tracking-tight">Profile Settings
                </h1>
                <p class="text-neutral-500 mt-1 text-sm">Update your account information and preferences.</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left Column: Personal Info Form -->
            <div class="lg:col-span-2 space-y-6">
                <div class="glass p-6 sm:p-8 rounded-3xl">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <div class="pb-6 border-b border-black/5 dark:border-white/5">
                            <h3 class="text-lg font-bold text-neutral-800 dark:text-white mb-6">Personal Information</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div class="md:col-span-2">
                                    <label for="name"
                                        class="block text-xs font-bold text-neutral-500 uppercase tracking-widest mb-2">Display
                                        Name <span class="text-rose-500">*</span></label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                        class="w-full bg-black/5 dark:bg-white/5 border border-transparent rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:bg-white dark:focus:bg-neutral-900 transition-all dark:text-white">
                                    @error('name')
                                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="md:col-span-2">
                                    <label for="email"
                                        class="block text-xs font-bold text-neutral-500 uppercase tracking-widest mb-2">Email
                                        Address <span class="text-rose-500">*</span></label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                        required
                                        class="w-full bg-black/5 dark:bg-white/5 border border-transparent rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:bg-white dark:focus:bg-neutral-900 transition-all dark:text-white">
                                    @error('email')
                                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="pb-6 border-b border-black/5 dark:border-white/5">
                            <h3 class="text-lg font-bold text-neutral-800 dark:text-white mb-6">Change Password</h3>
                            <p class="text-xs text-neutral-500 mb-6">Leave blank to keep the current password.</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- New Password -->
                                <div>
                                    <label for="password"
                                        class="block text-xs font-bold text-neutral-500 uppercase tracking-widest mb-2">New
                                        Password</label>
                                    <input type="password" name="password" id="password"
                                        class="w-full bg-black/5 dark:bg-white/5 border border-transparent rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:bg-white dark:focus:bg-neutral-900 transition-all dark:text-white">
                                    @error('password')
                                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation"
                                        class="block text-xs font-bold text-neutral-500 uppercase tracking-widest mb-2">Confirm
                                        Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="w-full bg-black/5 dark:bg-white/5 border border-transparent rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:bg-white dark:focus:bg-neutral-900 transition-all dark:text-white">
                                </div>
                            </div>
                        </div>

                        <div class="pt-2 flex justify-end">
                            <button type="submit"
                                class="bg-primary-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-primary-600 hover:scale-[1.02] transition-all active:scale-95 shadow-lg shadow-primary-500/20">
                                Save Changes
                            </button>
                        </div>

                </div>
            </div>

            <!-- Right Column: Profile Photo -->
            <div class="space-y-6">
                <div class="glass p-6 sm:p-8 rounded-3xl text-center">
                    <h3 class="text-lg font-bold text-neutral-800 dark:text-white mb-6">Profile Photo</h3>

                    <div class="relative inline-block mb-6 group">
                        <div
                            class="w-32 h-32 rounded-full border-4 border-white dark:border-neutral-800 shadow-xl overflow-hidden mx-auto bg-primary-50 flex items-center justify-center">
                            @if($user->profile_photo_path)
                                <img id="photoPreview" src="{{ Storage::url($user->profile_photo_path) }}" alt="Profile Photo"
                                    class="w-full h-full object-cover">
                            @else
                                <img id="photoPreview"
                                    src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3c50e0&color=fff&size=128"
                                    alt="Initials" class="w-full h-full object-cover">
                            @endif
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label for="profile_photo"
                            class="block w-full py-2.5 px-4 rounded-xl border-1 border-dashed border-neutral-300 dark:border-neutral-600 cursor-pointer hover:bg-black/5 dark:hover:bg-white/5 transition-colors">
                            <span class="text-sm font-bold text-primary-500">Choose a new photo</span>
                            <input type="file" name="profile_photo" id="profile_photo" class="hidden" accept="image/*"
                                onchange="previewImage(event)">
                        </label>
                        <p class="text-[10px] text-neutral-500 uppercase tracking-widest">JPG, GIF, or PNG. Max size 2MB</p>
                    </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('photoPreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection