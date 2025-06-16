@extends('layouts.user')

@section('title', 'My Profile')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6">
            <div class="w-24 h-24 rounded-full bg-[#ffd586e6] flex items-center justify-center text-2xl font-bold text-white">
                {{ substr($user->name, 0, 1) }}{{ substr($user->name, strpos($user->name, ' ') + 1, 1) }}
            </div>

            <div class="flex-1">
                <h1 class="text-2xl font-bold mb-2">{{ $user->name }}</h1>
                <p class="text-gray-600 mb-4">{{ $user->email }}</p>

                <div class="flex space-x-4">
                    <div>
                        <p class="text-sm text-gray-500">Events Attended</p>
                        <p class="font-bold">{{ $user->events()->where('start_time', '<', now())->count() }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Upcoming Events</p>
                        <p class="font-bold">{{ $user->events()->where('start_time', '>=', now())->count() }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Member Since</p>
                        <p class="font-bold">{{ $user->created_at->format('Y') }}</p>
                    </div>
                </div>
            </div>

            <button
                onclick="openEditModal()"
                class="px-4 py-2 border border-[#FF6B6B] text-[#FF6B6B] rounded-md hover:bg-[#FF6B6B] hover:text-white transition">
                Edit Profile
            </button>
        </div>
    </div>

    <h2 class="text-xl font-bold mb-4">My Upcoming Events</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @foreach($user->events()->where('start_time', '>=', now())->get() as $event)
            @include('components.event-card', [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'location' => $event->location,
                'date' => $event->start_time->format('F j, Y'),
                'category' => $event->category,
                'image' => $event->image,
                'isFree' => $event->is_free,
                'price' => $event->price,
                'isRegistered' => true
            ])
        @endforeach
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Edit Profile</h3>
            <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6B6B]">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6B6B]">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password (leave blank to keep current)</label>
                <input type="password" id="password" name="password"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6B6B]">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FF6B6B]">
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeEditModal()"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-[#FF6B6B] text-white rounded-md hover:bg-[#ff5252] transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal() {
        document.getElementById('editProfileModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editProfileModal').classList.add('hidden');
    }

    // Handle form submission with AJAX
    document.getElementById('editProfileForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the profile info on the page
                document.querySelector('.text-2xl.font-bold').textContent = data.user.name;
                document.querySelector('.text-gray-600').textContent = data.user.email;

                // Update the initials in the avatar
                const nameParts = data.user.name.split(' ');
                const initials = nameParts[0].charAt(0) + (nameParts.length > 1 ? nameParts[1].charAt(0) : '');
                document.querySelector('.rounded-full.text-2xl').textContent = initials;

                closeEditModal();

                // Show success message
                alert('Profile updated successfully!');
            } else {
                // Handle validation errors
                if (data.errors) {
                    // You would typically display these errors near the form fields
                    alert('Please fix the errors in the form.');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating your profile.');
        });
    });
</script>
@endsection
