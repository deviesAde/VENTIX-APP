@extends('layouts.organizer')

@section('title', 'Profil Saya')

@section('content')
<div class="space-y-6">
    <h2 class="text-2xl font-bold text-gray-800">Profil Saya</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Akun</h3>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('organizer.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-1">
                        <div class="flex items-center justify-center mb-4">
                            <div class="relative">
                                @if($organizer->logo_path)
                                    <img src="{{ asset('storage/' . $organizer->logo_path) }}" alt="Logo Organizer" class="w-32 h-32 rounded-full object-cover">
                                @else
                                    <div class="w-32 h-32 rounded-full bg-[#FFD586] flex items-center justify-center text-white text-4xl font-bold">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <input type="file" name="logo" id="logo" class="hidden" accept="image/*">
                                <label for="logo" class="absolute bottom-0 right-0 bg-[#FF9898] text-white p-2 rounded-full hover:bg-[#FF7A7A] cursor-pointer">
                                    <i class="fas fa-camera"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 space-y-4">
                        <div>
                            <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-gray-700 font-medium mb-2">Nomor Telepon</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone', $organizer->phone) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Informasi Organizer</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="organization_name" class="block text-gray-700 font-medium mb-2">Nama Organizer</label>
                            <input type="text" name="organization_name" id="organization_name" value="{{ old('organization_name', $organizer->organization_name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                            @error('organization_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="website" class="block text-gray-700 font-medium mb-2">Website</label>
                            <input type="url" name="website" id="website" value="{{ old('website', $organizer->website) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                            @error('website') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>


                        <div>
                            <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi Organizer</label>
                            <textarea name="description" id="description" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">{{ old('description', $organizer->description) }}</textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Ubah Password</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="current_password" class="block text-gray-700 font-medium mb-2">Password Saat Ini</label>
                            <input type="password" name="current_password" id="current_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                            @error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="new_password" class="block text-gray-700 font-medium mb-2">Password Baru</label>
                            <input type="password" name="new_password" id="new_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                            @error('new_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="new_password_confirmation" class="block text-gray-700 font-medium mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-6 border-t border-gray-200">
                    <button type="submit" class="px-6 py-2 bg-[#FF9898] hover:bg-[#FF7A7A] text-white rounded-lg">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
