@extends('layouts.user')

@section('title', 'Browse Events')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold mb-4">Upcoming Events</h1>
    <p class="text-gray-600">Discover amazing events around you</p>
</div>

<div class="mb-8">
    <div class="flex flex-wrap gap-4 mb-6">
        <button class="px-4 py-2 rounded-full bg-[#FF6B6B] text-white">All</button>
        @foreach(['music', 'seminar', 'sports', 'technology', 'art'] as $category)
            <button class="px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-300 transition capitalize">
                {{ $category }}
            </button>
        @endforeach
    </div>

    <div class="relative">
        <input type="text" placeholder="Search events..."
               class="w-full md:w-96 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FF6B6B]">
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($events as $event)
        @include('components.event-card', [
            'event' => $event,
            'isRegistered' => false
        ])
    @endforeach
</div>

<div class="mt-8">
    {{ $events->links() }}
</div>
@endsection
