@extends('layouts.organizer')

@section('title', 'Profil Saya')

@section('content')
<div class="space-y-6">
    <!-- Header Section with Gradient -->
    <div class="bg-gradient-to-r from-pink-400 via-red-400 to-orange-400 rounded-xl p-6 text-white shadow-lg">
        <div class="flex items-center space-x-4">
            <div class="p-3 bg-white/20 rounded-full backdrop-blur-sm">
                <i class="fas fa-user-edit text-2xl"></i>
            </div>
            <div>
                <h2 class="text-3xl font-bold">Profil Saya</h2>
                <p class="text-white/90 mt-1">Kelola informasi akun dan profil organizer Anda</p>
            </div>
        </div>
    </div>

    <!-- Enhanced Success Alert -->
    <div id="success-message" class="hidden">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg p-4 shadow-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-sm"></i>
                    </div>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-green-800 font-medium" id="success-text"></p>
                </div>
                <div class="flex-shrink-0">
                    <button type="button" class="text-green-400 hover:text-green-600 transition-colors" onclick="hideAlert('success-message')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Error Alert -->
    <div id="error-message" class="hidden">
        <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 rounded-lg p-4 shadow-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-white text-sm"></i>
                    </div>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-red-800 font-medium" id="error-text"></p>
                </div>
                <div class="flex-shrink-0">
                    <button type="button" class="text-red-400 hover:text-red-600 transition-colors" onclick="hideAlert('error-message')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Form Card with Enhanced Design -->
    <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-100">
        <!-- Card Header with Gradient -->
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-[#FF9898]/10 rounded-lg">
                    <i class="fas fa-id-card text-[#FF9898] text-lg"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Informasi Akun</h3>
            </div>
        </div>

        <div class="p-8">
            <form id="profile-form" method="POST" action="{{ route('organizer.profile.update') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Profile Picture Section -->
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="flex-1">
                        <div class="flex items-center justify-center mb-6">
                            <div class="relative group">
                                @if($organizer->logo_path)
                                    <img id="logo-preview" src="{{ asset('storage/' . $organizer->logo_path) }}" alt="Logo Organizer" class="w-36 h-36 rounded-full object-cover border-4 border-white shadow-xl group-hover:shadow-2xl transition-all duration-300">
                                @else
                                    <div id="initials-preview" class="w-36 h-36 rounded-full bg-gradient-to-br from-[#FFD586] to-[#FF9898] flex items-center justify-center text-white text-4xl font-bold shadow-xl group-hover:shadow-2xl transition-all duration-300 border-4 border-white">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <input type="file" name="logo" id="logo" class="hidden" accept="image/*">
                                <label for="logo" class="absolute -bottom-2 -right-2 bg-gradient-to-r from-[#FF9898] to-[#FF7A7A] text-white p-3 rounded-full hover:from-[#FF7A7A] hover:to-[#FF5A5A] cursor-pointer shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110">
                                    <i class="fas fa-camera text-sm"></i>
                                </label>
                                <div class="absolute inset-0 rounded-full bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <span class="text-white text-sm font-medium">Ubah Foto</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="flex-1 space-y-6">
                        <div class="group">
                            <label for="name" class="block text-gray-700 font-semibold mb-3 group-focus-within:text-[#FF9898] transition-colors">
                                <i class="fas fa-user mr-2 text-[#FF9898]"></i>Nama Lengkap
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF9898]/20 focus:border-[#FF9898] transition-all duration-300 hover:border-gray-300">
                            <span class="text-red-500 text-sm error-message mt-1 block" id="name-error"></span>
                        </div>

                        <div class="group">
                            <label for="email" class="block text-gray-700 font-semibold mb-3 group-focus-within:text-[#FF9898] transition-colors">
                                <i class="fas fa-envelope mr-2 text-[#FF9898]"></i>Email
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF9898]/20 focus:border-[#FF9898] transition-all duration-300 hover:border-gray-300">
                            <span class="text-red-500 text-sm error-message mt-1 block" id="email-error"></span>
                        </div>

                        <div class="group">
                            <label for="phone" class="block text-gray-700 font-semibold mb-3 group-focus-within:text-[#FF9898] transition-colors">
                                <i class="fas fa-phone mr-2 text-[#FF9898]"></i>Nomor Telepon
                            </label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone', $organizer->phone) }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF9898]/20 focus:border-[#FF9898] transition-all duration-300 hover:border-gray-300">
                            <span class="text-red-500 text-sm error-message mt-1 block" id="phone-error"></span>
                        </div>
                    </div>
                </div>

                <!-- Organizer Information Section -->
                <div class="pt-8 border-t-2 border-gray-100">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="p-2 bg-[#FF9898]/10 rounded-lg">
                            <i class="fas fa-building text-[#FF9898] text-lg"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Informasi Organizer</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label for="organization_name" class="block text-gray-700 font-semibold mb-3 group-focus-within:text-[#FF9898] transition-colors">
                                <i class="fas fa-tags mr-2 text-[#FF9898]"></i>Nama Organizer
                            </label>
                            <input type="text" name="organization_name" id="organization_name" value="{{ old('organization_name', $organizer->organization_name) }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF9898]/20 focus:border-[#FF9898] transition-all duration-300 hover:border-gray-300">
                            <span class="text-red-500 text-sm error-message mt-1 block" id="organization_name-error"></span>
                        </div>

                        <div class="group">
                            <label for="website" class="block text-gray-700 font-semibold mb-3 group-focus-within:text-[#FF9898] transition-colors">
                                <i class="fas fa-globe mr-2 text-[#FF9898]"></i>Website
                            </label>
                            <input type="url" name="website" id="website" value="{{ old('website', $organizer->website) }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF9898]/20 focus:border-[#FF9898] transition-all duration-300 hover:border-gray-300">
                            <span class="text-red-500 text-sm error-message mt-1 block" id="website-error"></span>
                        </div>

                        <div class="md:col-span-2 group">
                            <label for="description" class="block text-gray-700 font-semibold mb-3 group-focus-within:text-[#FF9898] transition-colors">
                                <i class="fas fa-align-left mr-2 text-[#FF9898]"></i>Deskripsi Organizer
                            </label>
                            <textarea name="description" id="description" rows="4" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF9898]/20 focus:border-[#FF9898] transition-all duration-300 hover:border-gray-300 resize-none">{{ old('description', $organizer->description) }}</textarea>
                            <span class="text-red-500 text-sm error-message mt-1 block" id="description-error"></span>
                        </div>
                    </div>
                </div>

                <!-- Password Section -->
                <div class="pt-8 border-t-2 border-gray-100">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="p-2 bg-[#FF9898]/10 rounded-lg">
                            <i class="fas fa-lock text-[#FF9898] text-lg"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Ubah Password</h3>
                    </div>

                    <div class="space-y-6">
                        <div class="group">
                            <label for="current_password" class="block text-gray-700 font-semibold mb-3 group-focus-within:text-[#FF9898] transition-colors">
                                <i class="fas fa-key mr-2 text-[#FF9898]"></i>Password Saat Ini
                            </label>
                            <div class="relative">
                                <input type="password" name="current_password" id="current_password" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF9898]/20 focus:border-[#FF9898] transition-all duration-300 hover:border-gray-300 pr-12">
                                <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-[#FF9898] focus:outline-none toggle-password transition-colors" data-target="current_password">
                                    <i class="far fa-eye text-lg"></i>
                                </button>
                            </div>
                            <span class="text-red-500 text-sm error-message mt-1 block" id="current_password-error"></span>
                        </div>

                        <div class="group">
                            <label for="new_password" class="block text-gray-700 font-semibold mb-3 group-focus-within:text-[#FF9898] transition-colors">
                                <i class="fas fa-lock mr-2 text-[#FF9898]"></i>Password Baru
                            </label>
                            <div class="relative">
                                <input type="password" name="new_password" id="new_password" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF9898]/20 focus:border-[#FF9898] transition-all duration-300 hover:border-gray-300 pr-12">
                                <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-[#FF9898] focus:outline-none toggle-password transition-colors" data-target="new_password">
                                    <i class="far fa-eye text-lg"></i>
                                </button>
                            </div>
                            <span class="text-red-500 text-sm error-message mt-1 block" id="new_password-error"></span>
                        </div>

                        <div class="group">
                            <label for="new_password_confirmation" class="block text-gray-700 font-semibold mb-3 group-focus-within:text-[#FF9898] transition-colors">
                                <i class="fas fa-check-circle mr-2 text-[#FF9898]"></i>Konfirmasi Password Baru
                            </label>
                            <div class="relative">
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF9898]/20 focus:border-[#FF9898] transition-all duration-300 hover:border-gray-300 pr-12">
                                <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-[#FF9898] focus:outline-none toggle-password transition-colors" data-target="new_password_confirmation">
                                    <i class="far fa-eye text-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-8 border-t-2 border-gray-100">
                    <button type="submit" class="group relative px-8 py-4 bg-gradient-to-r from-[#FF9898] to-[#FF7A7A] hover:from-[#FF7A7A] hover:to-[#FF5A5A] text-white font-semibold rounded-xl transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl flex items-center space-x-3">
                        <i class="fas fa-save"></i>
                        <span id="submit-text">Simpan Perubahan</span>
                        <i id="submit-spinner" class="fas fa-spinner fa-spin hidden"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Function to hide alerts
    function hideAlert(alertId) {
        document.getElementById(alertId).classList.add('hidden');
    }

    // Auto-hide alerts after 5 seconds
    function showAlert(type, message) {
        const alertElement = document.getElementById(`${type}-message`);
        const textElement = document.getElementById(`${type}-text`);

        textElement.textContent = message;
        alertElement.classList.remove('hidden');

        // Auto-hide after 5 seconds
        setTimeout(() => {
            alertElement.classList.add('hidden');
        }, 5000);
    }

    // Preview logo when selected
    document.getElementById('logo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const logoPreview = document.getElementById('logo-preview');
                const initialsPreview = document.getElementById('initials-preview');

                if (logoPreview) {
                    logoPreview.src = e.target.result;
                    logoPreview.classList.remove('hidden');
                } else {
                    // Create new image element if it doesn't exist
                    const newImg = document.createElement('img');
                    newImg.id = 'logo-preview';
                    newImg.src = e.target.result;
                    newImg.alt = 'Logo Organizer';
                    newImg.className = 'w-36 h-36 rounded-full object-cover border-4 border-white shadow-xl group-hover:shadow-2xl transition-all duration-300';
                    initialsPreview.parentNode.replaceChild(newImg, initialsPreview);
                }

                if (initialsPreview) {
                    initialsPreview.classList.add('hidden');
                }
            }
            reader.readAsDataURL(file);
        }
    });

    // Toggle password visibility with enhanced animation
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            const input = document.getElementById(target);
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
                this.classList.add('text-[#FF9898]');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
                this.classList.remove('text-[#FF9898]');
            }
        });
    });

    // Enhanced form submission with better UX
    document.getElementById('profile-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);
        const submitText = document.getElementById('submit-text');
        const submitSpinner = document.getElementById('submit-spinner');
        const submitButton = form.querySelector('button[type="submit"]');

        // Show loading state with animation
        submitText.textContent = 'Menyimpan...';
        submitSpinner.classList.remove('hidden');
        submitButton.disabled = true;
        submitButton.classList.add('opacity-80', 'cursor-not-allowed');

        // Clear previous errors with animation
        document.querySelectorAll('.error-message').forEach(el => {
            el.textContent = '';
            el.classList.add('opacity-0');
            setTimeout(() => el.classList.remove('opacity-0'), 300);
        });

        // Hide existing alerts
        document.getElementById('error-message').classList.add('hidden');
        document.getElementById('success-message').classList.add('hidden');

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show enhanced success message
                showAlert('success', data.message);

                // Update logo preview if changed
                if (data.logo_url) {
                    const logoPreview = document.getElementById('logo-preview');
                    if (logoPreview) {
                        logoPreview.src = data.logo_url;
                        logoPreview.classList.remove('hidden');
                    }
                    const initialsPreview = document.getElementById('initials-preview');
                    if (initialsPreview) {
                        initialsPreview.classList.add('hidden');
                    }
                }

                // Update initials if name changed
                if (data.user_initials) {
                    const initialsPreview = document.getElementById('initials-preview');
                    if (initialsPreview) {
                        initialsPreview.textContent = data.user_initials;
                    }
                }

                // Clear password fields after successful update
                document.getElementById('current_password').value = '';
                document.getElementById('new_password').value = '';
                document.getElementById('new_password_confirmation').value = '';

            } else {
                // Handle validation errors with animation
                if (data.errors) {
                    Object.keys(data.errors).forEach(key => {
                        const errorElement = document.getElementById(`${key}-error`);
                        if (errorElement) {
                            errorElement.textContent = data.errors[key][0];
                            errorElement.classList.add('animate-pulse');
                            setTimeout(() => errorElement.classList.remove('animate-pulse'), 2000);
                        }
                    });
                } else {
                    showAlert('error', data.message || 'Terjadi kesalahan saat menyimpan perubahan');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'Terjadi kesalahan saat menyimpan perubahan');
        })
        .finally(() => {
            // Reset button state with animation
            submitText.textContent = 'Simpan Perubahan';
            submitSpinner.classList.add('hidden');
            submitButton.disabled = false;
            submitButton.classList.remove('opacity-80', 'cursor-not-allowed');
        });
    });

    // Add smooth scroll animation for form sections
    document.querySelectorAll('input, textarea').forEach(element => {
        element.addEventListener('focus', function() {
            this.closest('.group').classList.add('scale-[1.02]');
        });

        element.addEventListener('blur', function() {
            this.closest('.group').classList.remove('scale-[1.02]');
        });
    });
</script>
@endpush
