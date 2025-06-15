@extends('layouts.user')

@section('title', 'Pembayaran Tiket')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Lanjutkan Pembayaran</h1>

        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <h2 class="text-lg font-semibold mb-4">Detail Pesanan</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="font-medium">{{ $event->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $event->formatted_date }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold">Rp {{ number_format($event->ticket_price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <div class="flex justify-between font-semibold">
                            <span>Total</span>
                            <span>Rp {{ number_format($event->ticket_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 bg-blue-50 p-4 rounded-lg">
                    <h3 class="font-medium text-blue-800 mb-2">Instruksi Pembayaran</h3>
                    <p class="text-sm text-blue-600">
                        Pembayaran harus diselesaikan dalam 24 jam. Tiket akan aktif setelah pembayaran berhasil.
                    </p>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-4">Pilih Metode Pembayaran</h2>
                <div id="snap-container" class="border rounded-lg p-4 bg-gray-50"></div>

                <div class="mt-4 text-sm text-gray-500">
                    <p>Kami menerima pembayaran via:</p>
                    <ul class="list-disc pl-5 mt-2">
                        <li>Transfer Bank (BNI, BRI, Mandiri, dll)</li>
                        <li>Kartu Kredit/Debit</li>
                        <li>E-Wallet (Gopay, OVO, DANA)</li>
                    </ul>
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
                window.location.href = '{{ route('events.ticket', $registration->id) }}';
            },
            onPending: function(result) {
                window.location.href = '{{ route('events.ticket', $registration->id) }}?status=confirmed';
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
