@extends('layouts.admin')

@section('title', 'Organizer Management')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-3">
                <div class="p-3 bg-gradient-to-r from-rose-400 to-pink-400 rounded-xl shadow-lg">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                        Organizer Management
                    </h2>
                    <p class="text-gray-500 text-sm mt-1">Manage and oversee event organizers</p>
                </div>
            </div>


             <<form method="GET" action="{{ route('admin.organizers.index') }}" class="flex items-center space-x-3 w-full sm:w-auto">
                <div class="relative flex-1 sm:flex-none">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search organizers..."
                        class="w-full sm:w-64 pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-rose-200 focus:border-rose-300 bg-white shadow-sm transition-all duration-200">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <button type="submit" class="bg-gradient-to-r from-rose-400 to-pink-400 hover:from-rose-500 hover:to-pink-500 text-white px-6 py-3 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center space-x-2">
                    <i class="fas fa-search"></i>
                    <span class="hidden sm:inline">Search</span>
                </button>
            </form>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400 text-green-700 p-4 mb-6 rounded-xl shadow-sm animate-pulse">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Error Alert -->
        @if(session('error'))
            <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-400 text-red-700 p-4 mb-6 rounded-xl shadow-sm animate-pulse">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Table Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden backdrop-blur-sm">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-table mr-2 text-gray-600"></i>
                    Organizers List
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table   id="organizer-table" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-building text-gray-400"></i>
                                    <span>Organization</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-address-book text-gray-400"></i>
                                    <span>Contact</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-globe text-gray-400"></i>
                                    <span>Website</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-flag text-gray-400"></i>
                                    <span>Status</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-calendar text-gray-400"></i>
                                    <span>Registered</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-cogs text-gray-400"></i>
                                    <span>Actions</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($organizers as $organizer)
                            <tr class="hover:bg-gradient-to-r hover:from-gray-50 hover:to-transparent transition-all duration-200 group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12 bg-gradient-to-br from-rose-400 to-pink-500 rounded-xl flex items-center justify-center text-white font-bold shadow-lg group-hover:scale-105 transition-transform duration-200">
                                            {{ substr($organizer->organization_name, 0, 1) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">{{ $organizer->organization_name }}</div>
                                            <div class="text-sm text-gray-500 flex items-center">
                                                <i class="fas fa-envelope text-xs mr-1"></i>
                                                {{ $organizer->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 flex items-center">
                                        <i class="fas fa-phone text-gray-400 mr-2"></i>
                                        {{ $organizer->phone }}
                                    </div>
                                    <div class="text-sm text-gray-500 flex items-center mt-1">
                                        <i class="fas fa-at text-gray-400 mr-2"></i>
                                        {{ $organizer->email }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($organizer->website)
                                        <a href="{{ $organizer->website }}" target="_blank"
                                            class="text-blue-500 hover:text-blue-700 hover:underline flex items-center transition-colors duration-200 group">
                                            <i class="fas fa-external-link-alt mr-2 text-sm group-hover:scale-110 transition-transform duration-200"></i>
                                            <span class="max-w-32 truncate">{{ parse_url($organizer->website, PHP_URL_HOST) }}</span>
                                        </a>
                                    @else
                                        <span class="text-gray-400 italic flex items-center">
                                            <i class="fas fa-minus-circle mr-2"></i>
                                            Not provided
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-2 inline-flex text-xs leading-5 font-semibold rounded-full shadow-sm
                                        {{ $organizer->status === 'approved' ? 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200' :
                                           ($organizer->status === 'pending' ? 'bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800 border border-yellow-200' : 'bg-gradient-to-r from-red-100 to-rose-100 text-red-800 border border-red-200') }}">
                                        <i class="fas {{ $organizer->status === 'approved' ? 'fa-check-circle' : ($organizer->status === 'pending' ? 'fa-clock' : 'fa-times-circle') }} mr-1"></i>
                                        {{ ucfirst($organizer->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                        <div>
                                            <div class="font-medium text-gray-700">{{ $organizer->created_at->format('M d, Y') }}</div>
                                            <div class="text-xs text-gray-400">{{ $organizer->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-1">
                                        <!-- View Details Button -->
                                        <button onclick="openOrganizerModal({{ json_encode($organizer) }})"
                                            class="text-gray-600 hover:text-blue-600 p-2 rounded-lg hover:bg-blue-50 transition-all duration-200 group">
                                            <i class="fas fa-eye group-hover:scale-110 transition-transform duration-200"></i>
                                        </button>

                                        <!-- Approve Button -->
                                        <form action="{{ route('admin.organizers.approve', $organizer->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="text-gray-400 hover:text-green-600 p-2 rounded-lg hover:bg-green-50 transition-all duration-200 group {{ $organizer->status === 'approved' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                {{ $organizer->status === 'approved' ? 'disabled' : '' }}>
                                                <i class="fas fa-check group-hover:scale-110 transition-transform duration-200"></i>
                                            </button>
                                        </form>

                                        <!-- Reject Button -->
                                        <form action="{{ route('admin.organizers.reject', $organizer->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="text-gray-400 hover:text-yellow-600 p-2 rounded-lg hover:bg-yellow-50 transition-all duration-200 group {{ $organizer->status === 'rejected' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                {{ $organizer->status === 'rejected' ? 'disabled' : '' }}>
                                                <i class="fas fa-ban group-hover:scale-110 transition-transform duration-200"></i>
                                            </button>
                                        </form>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.organizers.destroy', $organizer->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-gray-400 hover:text-red-600 p-2 rounded-lg hover:bg-red-50 transition-all duration-200 group"
                                                onclick="return confirm('Are you sure you want to delete this organizer?')">
                                                <i class="fas fa-trash group-hover:scale-110 transition-transform duration-200"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if($organizers->isEmpty())
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No organizers found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
            <div class="text-sm text-gray-600 bg-white px-4 py-2 rounded-lg shadow-sm border">
                <i class="fas fa-info-circle mr-2 text-gray-400"></i>
                Showing <span class="font-semibold">{{ $organizers->firstItem() }}</span> to
                <span class="font-semibold">{{ $organizers->lastItem() }}</span> of
                <span class="font-semibold">{{ $organizers->total() }}</span> organizers
            </div>

            <div class="flex space-x-2">
                {{ $organizers->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Organizer Detail Modal -->
<div id="organizerModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-black bg-opacity-50 backdrop-blur-sm" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-gray-200">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-rose-400 to-pink-500 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0 h-10 w-10 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-users text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white" id="modalOrgName">Organization Name</h3>
                    </div>
                    <button onclick="closeOrganizerModal()" class="text-white hover:text-gray-200 transition-colors duration-200">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="bg-white px-6 py-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <label class="block text-sm font-semibold text-gray-600 mb-1 flex items-center">
                                <i class="fas fa-envelope mr-2 text-gray-400"></i>
                                Email Address
                            </label>
                            <p class="text-sm text-gray-900 font-medium" id="modalOrgEmail">email@example.com</p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-xl">
                            <label class="block text-sm font-semibold text-gray-600 mb-1 flex items-center">
                                <i class="fas fa-phone mr-2 text-gray-400"></i>
                                Phone Number
                            </label>
                            <p class="text-sm text-gray-900 font-medium" id="modalOrgPhone">+1234567890</p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-xl">
                            <label class="block text-sm font-semibold text-gray-600 mb-1 flex items-center">
                                <i class="fas fa-globe mr-2 text-gray-400"></i>
                                Website
                            </label>
                            <p class="text-sm text-gray-900 font-medium" id="modalOrgWebsite">example.com</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <label class="block text-sm font-semibold text-gray-600 mb-1 flex items-center">
                                <i class="fas fa-flag mr-2 text-gray-400"></i>
                                Status
                            </label>
                            <div id="modalOrgStatus">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                            </div>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-xl">
                            <label class="block text-sm font-semibold text-gray-600 mb-1 flex items-center">
                                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                Registration Date
                            </label>
                            <p class="text-sm text-gray-900 font-medium" id="modalOrgDate">Jan 1, 2023</p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-xl">
                            <label class="block text-sm font-semibold text-gray-600 mb-1 flex items-center">
                                <i class="fas fa-chart-bar mr-2 text-gray-400"></i>
                                Events Count
                            </label>
                            <p class="text-sm text-gray-900 font-medium" id="modalOrgEvents">12 events</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end">
                <button type="button" onclick="closeOrganizerModal()"
                    class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-rose-400 to-pink-500 text-white font-medium rounded-xl hover:from-rose-500 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <i class="fas fa-times mr-2"></i>
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openOrganizerModal(organizer) {
        // Set modal content
        document.getElementById('modalOrgName').textContent = organizer.organization_name;
        document.getElementById('modalOrgEmail').textContent = organizer.email;
        document.getElementById('modalOrgPhone').textContent = organizer.phone || 'Not provided';

        const websiteElement = document.getElementById('modalOrgWebsite');
        if (organizer.website) {
            websiteElement.innerHTML = `<a href="${organizer.website}" target="_blank" class="text-blue-500 hover:underline flex items-center"><i class="fas fa-external-link-alt mr-1"></i>${organizer.website}</a>`;
        } else {
            websiteElement.textContent = 'Not provided';
        }

        const statusElement = document.getElementById('modalOrgStatus');
        statusElement.innerHTML = `
            <span class="px-3 py-2 inline-flex text-xs leading-5 font-semibold rounded-full shadow-sm
                ${organizer.status === 'approved' ? 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200' :
                  (organizer.status === 'pending' ? 'bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800 border border-yellow-200' : 'bg-gradient-to-r from-red-100 to-rose-100 text-red-800 border border-red-200')}">
                <i class="fas ${organizer.status === 'approved' ? 'fa-check-circle' : (organizer.status === 'pending' ? 'fa-clock' : 'fa-times-circle')} mr-1"></i>
                ${organizer.status.charAt(0).toUpperCase() + organizer.status.slice(1)}
            </span>
        `;

        const date = new Date(organizer.created_at);
        document.getElementById('modalOrgDate').textContent = date.toLocaleDateString('en-US', {
            year: 'numeric', month: 'short', day: 'numeric'
        });

        // For events count - you might need to fetch this data from your backend
        document.getElementById('modalOrgEvents').textContent = 'Loading...'; // Placeholder

        // Show modal
        document.getElementById('organizerModal').classList.remove('hidden');
    }

    function closeOrganizerModal() {
        document.getElementById('organizerModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('organizerModal');
        if (event.target === modal) {
            closeOrganizerModal();
        }
    }


</script>

<style>
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .page-item {
        margin: 0 2px;
    }

    .page-link {
        display: block;
        padding: 0.75rem 1rem;
        color: #4a5568;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        transition: all 0.2s ease;
        font-weight: 500;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
    }

    .page-link:hover {
        background: linear-gradient(to right, #fda4af, #fb7185);
        border-color: #fb7185;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px 0 rgb(251 113 133 / 0.4);
    }

    .page-item.active .page-link {
        background: linear-gradient(to right, #fb7185, #f43f5e);
        border-color: #f43f5e;
        color: white;
        box-shadow: 0 4px 12px 0 rgb(244 63 94 / 0.4);
    }

    .page-item.disabled .page-link {
        color: #a0aec0;
        background: #f7fafc;
        border-color: #e2e8f0;
        cursor: not-allowed;
        opacity: 0.6;
    }

    .page-item.disabled .page-link:hover {
        background: #f7fafc;
        transform: none;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
    }
</style>
@endsection
