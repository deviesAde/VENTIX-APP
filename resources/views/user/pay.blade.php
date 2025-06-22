@extends('layouts.user')

@section('title', 'Pembayaran Tiket')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 py-8">
    <div class="max-w-5xl mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Lanjutkan Pembayaran</h1>
            <p class="text-gray-600">Selesaikan transaksi Anda dengan mudah dan aman</p>
        </div>

        <div class="grid lg:grid-cols-5 gap-8">
            <!-- Order Details - Left Side -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6">
                        <h2 class="text-xl font-semibold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Detail Pesanan
                        </h2>
                    </div>

                    <!-- Event Details -->
                    <div class="p-6">
                        <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-6 rounded-xl border border-gray-100">
                            <div class="flex justify-between items-start mb-6">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                                        <span class="text-xs font-medium text-green-600 uppercase tracking-wide">Event Aktif</span>
                                    </div>
                                    <h3 class="font-bold text-lg text-gray-800 leading-tight">{{ $event->title }}</h3>
                                    <div class="flex items-center mt-2 text-gray-600">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm">{{ $event->formatted_date }}</span>
                                    </div>
                                </div>
                                <div class="text-right ml-4">
                                    <div class="bg-white rounded-lg p-3 shadow-sm border">
                                        <p class="text-xs text-gray-500 mb-1">Harga Tiket</p>
                                        <p class="font-bold text-xl text-gray-800">Rp {{ number_format($event->ticket_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Section -->
                            <div class="border-t border-gray-200 pt-4">
                                <div class="bg-white rounded-lg p-4 shadow-sm">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-semibold text-gray-700">Total Pembayaran</span>
                                        <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($event->ticket_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Instructions -->
                        <div class="mt-6 bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-200">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-semibold text-blue-800 mb-2">Instruksi Pembayaran</h3>
                                    <div class="space-y-2">
                                        <div class="flex items-center text-sm text-blue-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Pembayaran harus diselesaikan dalam <strong>24 jam</strong>
                                        </div>
                                        <div class="flex items-center text-sm text-blue-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Tiket akan aktif setelah pembayaran berhasil
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Method - Right Side -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 p-6">
                        <h2 class="text-xl font-semibold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Pilih Metode Pembayaran
                        </h2>
                        <p class="text-purple-100 text-sm mt-1">Pilih metode pembayaran yang sesuai untuk Anda</p>
                    </div>

                    <!-- Payment Container -->
                    <div class="p-6">
                        <div id="snap-container" class="border-2 border-dashed border-gray-300 rounded-xl p-8 bg-gradient-to-br from-gray-50 to-white min-h-[300px] flex items-center justify-center">
                            <div class="text-center">
                                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-500 mx-auto mb-4"></div>
                                <p class="text-gray-500">Memuat metode pembayaran...</p>
                            </div>
                        </div>

                        <!-- Payment Methods Info -->
                        <div class="mt-8 bg-gradient-to-r from-gray-50 to-purple-50 p-6 rounded-xl border border-gray-200">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-800 mb-3">Kami menerima pembayaran via:</h4>
                                    <div class="space-y-3">
                                        <div class="flex items-center">
                                            <div class="w-10 h-6 bg-gradient-to-r from-blue-500 to-blue-600 rounded flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M4 4h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                                                </svg>
                                            </div>
                                            <span class="text-sm text-gray-700 font-medium">Transfer Bank (BNI, BRI, Mandiri, dll)</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-10 h-6 bg-gradient-to-r from-green-500 to-green-600 rounded flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M4 4h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                                                </svg>
                                            </div>
                                            <span class="text-sm text-gray-700 font-medium">Kartu Kredit/Debit</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-10 h-6 bg-gradient-to-r from-purple-500 to-purple-600 rounded flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                                                </svg>
                                            </div>
                                            <span class="text-sm text-gray-700 font-medium">E-Wallet (Gopay, OVO, DANA)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Security Badge -->
                        <div class="mt-6 text-center">
                            <div class="inline-flex items-center px-4 py-2 bg-green-50 rounded-full border border-green-200">
                                <svg class="w-4 h-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <span class="text-sm font-medium text-green-700">Pembayaran Aman & Terenkripsi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                fetch('/user/registration/{{ $registration->id }}/manual-check')
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'settlement' || data.status === 'capture') {
                            window.location.href = '{{ route('events.ticket', $registration->id) }}';
                        } else {
                            alert("Pembayaran belum dikonfirmasi.");
                            window.location.href = '{{ route('events.ticket', $registration->id) }}';
                        }
                    })
                    .catch(error => {
                        console.error('Error saat cek manual:', error);
                        window.location.href = '{{ route('events.ticket', $registration->id) }}';
                    });
            },
            onPending: function(result) {
                alert("Pembayaran masih pending.");
                window.location.href = '{{ route('events.ticket', $registration->id) }}';
            },
            onError: function(result) {
                alert("Pembayaran gagal: " + result.status_message);
                window.location.href = '{{ route('events.show', $event->id) }}';
            },
            onClose: function() {
                alert("Anda menutup halaman pembayaran. Silakan lanjutkan pembayaran sebelum batas waktu habis.");
            }
        });
    });
</script>
@endsection
