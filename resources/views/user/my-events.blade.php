@extends('layouts.user')

@section('title', 'My Events')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold mb-2">My Events</h1>
    <div class="flex space-x-4">
        <button class="px-4 py-2 rounded-full bg-[#FF6B6B] text-white">Upcoming</button>
        <button class="px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-300 transition">Past Events</button>
    </div>
</div>

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

    @include('components.event-card', [
        'id' => 7,
        'title' => 'Charity Gala Dinner',
        'description' => 'Elegant evening supporting local charities with fine dining and entertainment.',
        'location' => 'Grand Hotel, Miami',
        'date' => 'December 10, 2023',
        'category' => 'Charity',
        'image' => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
        'isFree' => false,
        'price' => 150.00,
        'isRegistered' => true
    ])
</div>

<h2 class="text-xl font-bold mb-4">Past Events</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @include('components.event-card', [
        'id' => 8,
        'title' => 'Spring Jazz Festival',
        'description' => 'Weekend of smooth jazz performances in the park.',
        'location' => 'City Park, Seattle',
        'date' => 'May 15-16, 2023',
        'category' => 'Music',
        'image' => 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
        'isFree' => false,
        'price' => 35.00,
        'isRegistered' => true
    ])

    @include('components.event-card', [
        'id' => 9,
        'title' => 'Digital Marketing Workshop',
        'description' => 'Learn the latest strategies in digital marketing from industry experts.',
        'location' => 'Business Center, Denver',
        'date' => 'March 8, 2023',
        'category' => 'Business',
        'image' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
        'isFree' => true,
        'price' => 0,
        'isRegistered' => true
    ])
</div>
@endsection
