@extends('layouts.organizer')

@section('title', 'Profil Saya')

@section('content')
<div class="space-y-6">
    <h2 class="text-2xl font-bold text-gray-800">Profil Saya</h2>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Akun</h3>
        </div>
        <div class="p-6">
            <form class="space-y-6">
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-1">
                        <div class="flex items-center justify-center mb-4">
                            <div class="relative">
                                <div class="w-32 h-32 rounded-full bg-[#FFD586] flex items-center justify-center text-white text-4xl font-bold">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <button class="absolute bottom-0 right-0 bg-[#FF9898] text-white p-2 rounded-full hover:bg-[#FF7A7A]">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 space-y-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                            <input type="text" value="{{ auth()->user()->name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Email</label>
                            <input type="email" value="{{ auth()->user()->email }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nomor Telepon</label>
                            <input type="tel" value="081234567890" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Informasi Organizer</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nama Organizer</label>
                            <input type="text" value="EventKu Organizer" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Website</label>
                            <input type="url" value="https://eventku.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Alamat</label>
                            <textarea rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">Jl. Contoh No. 123, Jakarta</textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Deskripsi Organizer</label>
                            <textarea rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">Kami adalah penyelenggara event profesional dengan pengalaman lebih dari 5 tahun</textarea>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Ubah Password</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Password Saat Ini</label>
                            <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Password Baru</label>
                            <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Konfirmasi Password Baru</label>
                            <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
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
