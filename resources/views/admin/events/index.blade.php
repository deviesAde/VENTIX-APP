@extends('layouts.admin')

@section('title', 'Event Management')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Event Management</h2>
        <div class="flex space-x-2">
            <input type="text" placeholder="Search events..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFD586]">
            <button class="px-4 py-2 bg-[#FF9898] text-white rounded-lg hover:bg-[#FFD586] transition">
                Search
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="flex justify-between items-center p-4 border-b">
            <div class="flex space-x-2">
                <button class="px-4 py-2 bg-[#FFD586] text-gray-800 rounded-lg">All Events</button>
                <button class="px-4 py-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100">Pending</button>
                <button class="px-4 py-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100">Approved</button>
                <button class="px-4 py-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100">Rejected</button>
                <button class="px-4 py-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100">Featured</button>
            </div>
            <button class="px-4 py-2 bg-[#FF9898] text-white rounded-lg hover:bg-[#FFD586] transition">
                Export CSV
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Organizer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @for($i = 0; $i < 5; $i++)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded" src="https://via.placeholder.com/40" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Music Festival 2023</div>
                                    <div class="text-sm text-gray-500">Category: Music</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Event Pro</div>
                            <div class="text-sm text-gray-500">ID: ORG123</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">15 Dec 2023</div>
                            <div class="text-sm text-gray-500">10:00 AM</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($i % 3 == 0)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            @elseif($i % 3 == 1)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <input type="checkbox" class="h-4 w-4 text-[#FF9898] focus:ring-[#FFD586] border-gray-300 rounded">
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button class="text-[#FF9898] hover:text-[#FFD586]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <button class="text-[#FF9898] hover:text-[#FFD586]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button class="text-[#FF9898] hover:text-[#FFD586]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
            <div class="flex-1 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">97</span> results
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" aria-current="page" class="z-10 bg-[#FFD586] border-[#FF9898] text-gray-700 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            1
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            2
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            3
                        </a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
