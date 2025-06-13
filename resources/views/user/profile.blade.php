@extends('layouts.user')

@section('title', 'My Profile')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6">
            <div class="w-24 h-24 rounded-full bg-[#ffd586e6] flex items-center justify-center text-2xl font-bold text-white">JD</div>

            <div class="flex-1">
                <h1 class="text-2xl font-bold mb-2">John Doe</h1>
                <p class="text-gray-600 mb-4">john.doe@example.com</p>

                <div class="flex space-x-4">
                    <div>
                        <p class="text-sm text-gray-500">Events Attended</p>
                        <p class="font-bold">12</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Upcoming Events</p>
                        <p class="font-bold">3</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Member Since</p>
                        <p class="font-bold">2022</p>
                    </div>
                </div>
            </div>

            <button class="px-4 py-2 border border-[#FF6B6B] text-[#FF6B6B] rounded-md hover:bg-[#FF6B6B] hover:text-white transition">
                Edit Profile
            </button>
        </div>
    </div>

    <h2 class="text-xl font-bold mb-4">My Upcoming Events</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @include('components.event-card', [
            'id' => 2,
            'title' => 'Tech Conference 2023',
            'description' => 'Annual technology conference showcasing the latest innovations and trends in the tech industry.',
            'location' => 'Convention Center, San Francisco',
            'date' => 'August 20-22, 2023',
            'category' => 'Technology',
            'image' => 'https://images.unsplash.com/photo-1431540015161-0bf868a2d407?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
            'isFree' => true,
            'price' => 0,
            'isRegistered' => true
        ])

        @include('components.event-card', [
            'id' => 4,
            'title' => 'Yoga in the Park',
            'description' => 'Morning yoga session in the beautiful city park. All levels welcome.',
            'location' => 'Riverside Park, Boston',
            'date' => 'Every Saturday',
            'category' => 'Wellness',
            'image' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
            'isFree' => true,
            'price' => 0,
            'isRegistered' => true
        ])
    </div>
</div>
@endsection
