@extends('layouts.admin')

@section('title', 'Organizer Management')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Organizer Management</h2>
        <div class="flex space-x-2">
            <input type="text" placeholder="Search organizers..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-200">
            <button class="bg-[#FFAAAA] hover:bg-red-400 text-white px-4 py-2 rounded-lg transition duration-200">
                <i class="fas fa-search mr-2"></i>Search
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2 text-green-500"></i>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Website</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($organizers as $organizer)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-[#FFAAAA] rounded-full flex items-center justify-center text-white font-bold">
                                        {{ substr($organizer->organization_name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $organizer->organization_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $organizer->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $organizer->phone }}</div>
                                <div class="text-sm text-gray-500">{{ $organizer->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($organizer->website)
                                    <a href="{{ $organizer->website }}" target="_blank" class="text-blue-500 hover:text-blue-700 hover:underline flex items-center">
                                        <i class="fas fa-external-link-alt mr-1 text-sm"></i>
                                        {{ parse_url($organizer->website, PHP_URL_HOST) }}
                                    </a>
                                @else
                                    <span class="text-gray-400 italic">Not provided</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $organizer->status === 'approved' ? 'bg-green-100 text-green-800' :
                                       ($organizer->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($organizer->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $organizer->created_at->format('M d, Y') }}
                                <div class="text-xs text-gray-400">{{ $organizer->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <!-- View Details Button -->
                                    <button onclick="openOrganizerModal({{ json_encode($organizer) }})"
                                        class="text-gray-600 hover:text-gray-900 p-1 rounded-full hover:bg-gray-100">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Approve Button -->
                                    <form action="{{ route('admin.organizers.approve', $organizer->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900 p-1 rounded-full hover:bg-green-100"
                                            {{ $organizer->status === 'approved' ? 'disabled' : '' }}>
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>

                                    <!-- Reject Button -->
                                    <form action="{{ route('admin.organizers.reject', $organizer->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-yellow-600 hover:text-yellow-900 p-1 rounded-full hover:bg-yellow-100"
                                            {{ $organizer->status === 'rejected' ? 'disabled' : '' }}>
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.organizers.destroy', $organizer->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 p-1 rounded-full hover:bg-red-100"
                                            onclick="return confirm('Are you sure you want to delete this organizer?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-500">
            Showing {{ $organizers->firstItem() }} to {{ $organizers->lastItem() }} of {{ $organizers->total() }} organizers
        </div>
        
        <div class="flex space-x-2">
            {{ $organizers->links() }}
        </div>
    </div>
</div>

<!-- Organizer Detail Modal -->
<div id="organizerModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-[#FFAAAA] sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalOrgName">Organization Name</h3>
                        <div class="mt-4 grid grid-cols-1 gap-y-4 gap-x-8 sm:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Email</label>
                                <p class="mt-1 text-sm text-gray-900" id="modalOrgEmail">email@example.com</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Phone</label>
                                <p class="mt-1 text-sm text-gray-900" id="modalOrgPhone">+1234567890</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Website</label>
                                <p class="mt-1 text-sm text-gray-900" id="modalOrgWebsite">example.com</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Status</label>
                                <p class="mt-1 text-sm" id="modalOrgStatus">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Registration Date</label>
                                <p class="mt-1 text-sm text-gray-900" id="modalOrgDate">Jan 1, 2023</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Events Count</label>
                                <p class="mt-1 text-sm text-gray-900" id="modalOrgEvents">12 events</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeOrganizerModal()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#FFAAAA] text-base font-medium text-white hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
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
            websiteElement.innerHTML = `<a href="${organizer.website}" target="_blank" class="text-blue-500 hover:underline">${organizer.website}</a>`;
        } else {
            websiteElement.textContent = 'Not provided';
        }

        const statusElement = document.getElementById('modalOrgStatus');
        statusElement.innerHTML = `
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                ${organizer.status === 'approved' ? 'bg-green-100 text-green-800' :
                  (organizer.status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')}">
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
    }

    .page-item {
        margin: 0 2px;
    }

    .page-link {
        display: block;
        padding: 0.5rem 0.75rem;
        color: #4a5568;
        background-color: white;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        transition: all 0.2s;
    }

    .page-link:hover {
        background-color: #f7fafc;
        border-color: #cbd5e0;
    }

    .page-item.active .page-link {
        background-color: #FFAAAA;
        border-color: #FFAAAA;
        color: white;
    }

    .page-item.disabled .page-link {
        color: #a0aec0;
        background-color: #f7fafc;
        border-color: #e2e8f0;
        cursor: not-allowed;
    }
</style>
@endsection
