@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Profile Header with #FFAAAA color -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Edit Profile</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-[#FFAAAA] hover:text-[#FF9999] font-medium">
                <i class="fas fa-arrow-left mr-1"></i> Back to Dashboard
            </a>
        </div>

        <!-- Success Message with #FFD586 accent -->
        @if(session('success'))
            <div class="bg-[#FFD586] bg-opacity-20 border-l-4 border-[#FFD586] text-gray-800 p-4 mb-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2 text-[#FFD586]"></i>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Error Message with #FFAAAA accent -->
        @if($errors->any())
            <div class="bg-[#FFAAAA] bg-opacity-20 border-l-4 border-[#FFAAAA] text-gray-800 p-4 mb-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2 text-[#FFAAAA]"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6">
                <!-- User Info Header with #FFD586 background -->
                <div class="bg-[#FFD586] bg-opacity-30 p-4 rounded-lg mb-8">
                    <h2 class="text-xl font-semibold text-gray-800">{{ auth()->user()->name }}</h2>
                    <p class="text-gray-600">{{ auth()->user()->email }}</p>
                </div>

                <!-- Profile Form -->
                <form method="POST" action="{{ route('admin.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <!-- Personal Information Section -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 border-b-2 border-[#FFAAAA] pb-2 mb-4">
                            Personal Information
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFAAAA] focus:border-transparent">
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFAAAA] focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Password Section -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 border-b-2 border-[#FFAAAA] pb-2 mb-4">
                            Change Password
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Current Password -->
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                <input type="password" id="current_password" name="current_password"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFAAAA] focus:border-transparent">
                            </div>

                            <!-- New Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                <input type="password" id="password" name="password"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFAAAA] focus:border-transparent">
                            </div>

                            <!-- Confirm Password -->
                            <div class="md:col-span-2">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFAAAA] focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions with #FFAAAA button -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-[#FFAAAA] hover:bg-[#FF9999] text-white font-medium py-2 px-6 rounded-lg shadow-md transition duration-200">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
