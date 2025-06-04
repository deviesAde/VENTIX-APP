@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users Card -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-[#FF9898]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Total Users</p>
                    <h3 class="text-2xl font-bold">1,245</h3>
                </div>
                <div class="p-3 rounded-full bg-[#FFD586]">
                    <svg class="w-6 h-6 text-[#FF9898]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Organizers Card -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-[#FF9898]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Total Organizers</p>
                    <h3 class="text-2xl font-bold">86</h3>
                </div>
                <div class="p-3 rounded-full bg-[#FFD586]">
                    <svg class="w-6 h-6 text-[#FF9898]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Events Card -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-[#FF9898]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Total Events</p>
                    <h3 class="text-2xl font-bold">312</h3>
                </div>
                <div class="p-3 rounded-full bg-[#FFD586]">
                    <svg class="w-6 h-6 text-[#FF9898]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Transactions Card -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-[#FF9898]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Total Transactions</p>
                    <h3 class="text-2xl font-bold">1,024</h3>
                </div>
                <div class="p-3 rounded-full bg-[#FFD586]">
                    <svg class="w-6 h-6 text-[#FF9898]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Events Section -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Popular Events</h2>
            <a href="{{ route('admin.events.index') }}" class="text-[#FF9898] hover:underline">View All</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Organizer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tickets Sold</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Music Festival 2023</div>
                                    <div class="text-sm text-gray-500">Category: Music</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Event Pro</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">15 Dec 2023</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">1,245</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-[#FF9898] hover:text-[#FFD586] mr-3">View</a>
                            <a href="#" class="text-[#FF9898] hover:text-[#FFD586]">Edit</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
