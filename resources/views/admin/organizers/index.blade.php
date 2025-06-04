@extends('layouts.admin')

@section('title', 'Organizer Management')
@section('icon', 'fa-users')

@section('breadcrumbs')
    <li aria-current="page">
        <div class="flex items-center">
            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
            <span class="text-sm font-medium text-gray-500">Organizers</span>
        </div>
    </li>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                <i class="fas fa-users text-[#FF9898] mr-3"></i>
                Organizer Management
            </h2>
            <p class="text-sm text-gray-600 mt-1">Manage all event organizers in the system</p>
        </div>

        <!-- Search and Filter -->
        <div class="w-full md:w-auto flex flex-col sm:flex-row gap-3">
            <div class="relative flex-grow">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" placeholder="Search organizers..."
                       class="pl-10 pr-4 py-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FFD586]">
            </div>
            <button class="px-4 py-2 bg-[#FF9898] text-white rounded-lg hover:bg-[#FF7D7D] transition flex items-center justify-center">
                <i class="fas fa-search mr-2"></i>
                <span class="hidden sm:inline">Search</span>
            </button>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Filter Tabs -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center p-4 border-b gap-3">
            <div class="flex flex-wrap gap-2">
                <button class="px-4 py-2 bg-[#FFD586] text-gray-800 rounded-lg flex items-center">
                    <i class="fas fa-list mr-2"></i>
                    All Organizers
                </button>
                <button class="px-4 py-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100 flex items-center">
                    <i class="fas fa-clock mr-2 text-yellow-500"></i>
                    Pending
                </button>
                <button class="px-4 py-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100 flex items-center">
                    <i class="fas fa-check-circle mr-2 text-green-500"></i>
                    Approved
                </button>
                <button class="px-4 py-2 bg-white text-gray-800 rounded-lg hover:bg-gray-100 flex items-center">
                    <i class="fas fa-times-circle mr-2 text-red-500"></i>
                    Rejected
                </button>
            </div>
            <button class="px-4 py-2 bg-[#FF9898] text-white rounded-lg hover:bg-[#FF7D7D] transition flex items-center">
                <i class="fas fa-file-export mr-2"></i>
                <span class="hidden sm:inline">Export CSV</span>
            </button>
        </div>

        <!-- Responsive Table Container -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                Organizer
                                <button class="ml-1 text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-sort"></i>
                                </button>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                            Contact
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                            Events
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">
                            Registered
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @for($i = 0; $i < 5; $i++)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Event+Pro&background=FF9898&color=fff" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Event Pro Organizer</div>
                                    <div class="text-sm text-gray-500">ID: ORG{{ 100 + $i }}</div>
                                    <div class="text-xs text-gray-400 md:hidden">contact@eventpro.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                            <div class="text-sm text-gray-900">contact@eventpro.com</div>
                            <div class="text-sm text-gray-500">+1 234 567 890</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                            <div class="flex items-center">
                                <span class="text-sm text-gray-900 mr-2">15</span>
                                <span class="text-xs px-2 py-1 bg-[#FFD586] rounded-full">+3 new</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($i % 3 == 0)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 flex items-center">
                                <i class="fas fa-clock mr-1"></i> Pending
                            </span>
                            @elseif($i % 3 == 1)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 flex items-center">
                                <i class="fas fa-check-circle mr-1"></i> Approved
                            </span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 flex items-center">
                                <i class="fas fa-times-circle mr-1"></i> Rejected
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden lg:table-cell">
                            {{ now()->subDays($i)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right">
                            <div class="flex justify-end space-x-2">
                                <button class="text-[#FF9898] hover:text-[#FF7D7D] p-1 rounded-full hover:bg-gray-100" title="View">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-[#FF9898] hover:text-[#FF7D7D] p-1 rounded-full hover:bg-gray-100" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="text-[#FF9898] hover:text-[#FF7D7D] p-1 rounded-full hover:bg-gray-100" title="Message">
                                    <i class="fas fa-envelope"></i>
                                </button>
                                <button class="text-[#FF9898] hover:text-[#FF7D7D] p-1 rounded-full hover:bg-gray-100" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-700">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">25</span> organizers
                </div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Previous</span>
                        <i class="fas fa-chevron-left"></i>
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
                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                        ...
                    </span>
                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                        8
                    </a>
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Next</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
