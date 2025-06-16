@extends('layouts.organizer')

@section('title', 'Scan Ticket')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-8">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full mb-4 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M12 12h4.01M12 12v4.01M12 12v4.01"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Ticket Scanner</h1>
            <p class="text-lg text-gray-600">Scan QR codes to check-in attendees</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Scanner Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <!-- Scanner Header -->
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-8 py-6">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-semibold text-white">QR Code Scanner</h2>
                        </div>
                    </div>

                    <!-- Scanner Body -->
                    <div class="p-8">
                        <div class="text-center">
                            <div id="scanner-container" class="mb-6 relative">
                                <div class="relative inline-block">
                                    <video id="scanner"
                                           class="rounded-xl border-4 border-dashed border-gray-300 bg-gray-50 max-w-full h-auto"
                                           style="max-width: 500px; min-height: 300px;"></video>

                                    <!-- Scanner Overlay -->
                                    <div class="absolute inset-0 pointer-events-none">
                                        <div class="absolute top-4 left-4 w-8 h-8 border-l-4 border-t-4 border-blue-500 rounded-tl-lg"></div>
                                        <div class="absolute top-4 right-4 w-8 h-8 border-r-4 border-t-4 border-blue-500 rounded-tr-lg"></div>
                                        <div class="absolute bottom-4 left-4 w-8 h-8 border-l-4 border-b-4 border-blue-500 rounded-bl-lg"></div>
                                        <div class="absolute bottom-4 right-4 w-8 h-8 border-r-4 border-b-4 border-blue-500 rounded-br-lg"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Scanner Controls -->
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <button id="start-scanner"
                                        class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    </svg>
                                    <span>Start Scanner</span>
                                </button>

                                <button id="stop-scanner"
                                        class="hidden bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path>
                                    </svg>
                                    <span>Stop Scanner</span>
                                </button>

                                <a href="{{ route('organizer.scan.manual') }}"
                                   class="bg-gradient-to-r from-gray-500 to-slate-600 hover:from-gray-600 hover:to-slate-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    <span>Manual Entry</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket Information Section -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden sticky top-8">
                    <!-- Info Header -->
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-5">
                        <div class="flex items-center">
                            <div class="w-7 h-7 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-white">Ticket Information</h3>
                        </div>
                    </div>

                    <!-- Info Body -->
                    <div class="p-6" id="ticket-info">
                        <div class="text-center text-gray-500 py-12">
                            <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                            </div>
                            <p class="text-lg font-medium mb-2">No Ticket Scanned</p>
                            <p class="text-sm">Scan a QR code to view ticket details</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Check-in Modal -->
<div class="modal fade" id="checkInModal" tabindex="-1" role="dialog" aria-labelledby="checkInModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-2xl border-0 shadow-2xl">
            <div class="modal-header bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-t-2xl border-0">
                <h5 class="modal-title font-semibold text-xl" id="checkInModalLabel">
                    <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Confirm Check-In
                </h5>
                <button type="button" class="close text-white opacity-75 hover:opacity-100" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-6">
                <div class="text-center mb-4">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <p class="text-lg font-medium text-gray-800 mb-2">Ready to check in this attendee?</p>
                </div>
                <div id="attendee-details" class="bg-gray-50 rounded-xl p-4"></div>
            </div>
            <div class="modal-footer border-0 px-6 pb-6">
                <button type="button" class="btn bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-6 rounded-xl transition-all duration-200" data-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold py-2 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 ml-2" id="confirm-check-in">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Check In
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quagga@0.12.1/dist/quagga.min.js"></script>
<script>
    $(document).ready(function() {
        let scannerActive = false;
        const scannerElement = document.getElementById('scanner');
        const startButton = $('#start-scanner');
        const stopButton = $('#stop-scanner');
        const ticketInfo = $('#ticket-info');
        const checkInModal = $('#checkInModal');
        let currentRegistration = null;

        // Start scanner
        startButton.on('click', function() {
            startScanner();
        });

        // Stop scanner
        stopButton.on('click', function() {
            stopScanner();
        });

        // Check-in confirmation
        $('#confirm-check-in').on('click', function() {
            if (!currentRegistration) return;

            $.ajax({
                url: '{{ route("organizer.scan.check-in") }}',
                method: 'POST',
                data: {
                    registration_id: currentRegistration.id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        loadTicketInfo(currentRegistration.id);
                        checkInModal.modal('hide');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error('An error occurred during check-in');
                }
            });
        });

        function startScanner() {
            if (scannerActive) return;

            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: scannerElement,
                    constraints: {
                        width: 480,
                        height: 320,
                        facingMode: "environment"
                    },
                },
                decoder: {
                    readers: ["qrcode_reader"]
                },
                locate: true
            }, function(err) {
                if (err) {
                    console.error(err);
                    toastr.error('Error initializing scanner: ' + err.message);
                    return;
                }
                scannerActive = true;
                startButton.addClass('hidden');
                stopButton.removeClass('hidden');
                Quagga.start();
            });

            Quagga.onDetected(function(result) {
                const code = result.codeResult.code;

                try {
                    // Verify the ticket
                    $.ajax({
                        url: '{{ route("organizer.scan.verify") }}',
                        method: 'POST',
                        data: {
                            ticket_data: code,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                currentRegistration = response.registration;
                                loadTicketInfo(response.registration.id);

                                // Stop scanner after successful scan
                                stopScanner();
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function() {
                            toastr.error('Error verifying ticket');
                        }
                    });
                } catch (e) {
                    toastr.error('Invalid QR code format');
                }
            });
        }

        function stopScanner() {
            if (!scannerActive) return;

            Quagga.stop();
            scannerActive = false;
            startButton.removeClass('hidden');
            stopButton.addClass('hidden');
        }

        function loadTicketInfo(registrationId) {
            $.get('/organizer/registrations/' + registrationId, function(response) {
                const statusColor = response.registration.status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
                const checkedInStatus = response.is_checked_in ?
                    `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Yes (${response.registration.checked_in_at})
                    </span>` :
                    `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        No
                    </span>`;

                ticketInfo.html(`
                    <div class="ticket-details">
                        <div class="text-center mb-6">
                            <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                            </div>
                            ${response.qr_code}
                        </div>

                        <div class="space-y-4">
                            <div class="bg-gray-50 rounded-xl p-4">
                                <h5 class="font-semibold text-gray-800 mb-2">${response.event.title}</h5>
                                <div class="text-sm text-gray-600 space-y-1">
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        ${response.event.start_date}
                                    </p>
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        ${response.event.location}
                                    </p>
                                </div>
                            </div>

                            <div class="bg-blue-50 rounded-xl p-4">
                                <h5 class="font-semibold text-gray-800 mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Attendee Information
                                </h5>
                                <div class="space-y-2 text-sm">
                                    <p><span class="font-medium text-gray-700">Name:</span> ${response.user.name}</p>
                                    <p><span class="font-medium text-gray-700">Email:</span> ${response.user.email}</p>
                                    <p><span class="font-medium text-gray-700">Ticket:</span> <code class="bg-gray-200 px-2 py-1 rounded text-xs">${response.registration.ticket_number}</code></p>
                                    <p><span class="font-medium text-gray-700">Status:</span> <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusColor}">${response.registration.status}</span></p>
                                    <p><span class="font-medium text-gray-700">Checked In:</span> ${checkedInStatus}</p>
                                </div>
                            </div>

                            ${response.is_checked_in ?
                                '<div class="bg-blue-100 border border-blue-200 rounded-xl p-4 text-center"><p class="text-blue-800 font-medium">✓ This ticket has already been checked in</p></div>' :
                                '<button class="check-in-btn w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span>Check In Now</span></button>'
                            }
                        </div>
                    </div>
                `);

                // Set up check-in button
                $('.check-in-btn').on('click', function() {
                    $('#attendee-details').html(`
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600">Event:</span>
                                <span class="text-gray-800">${response.event.title}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600">Attendee:</span>
                                <span class="text-gray-800">${response.user.name}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600">Ticket:</span>
                                <code class="bg-gray-200 px-2 py-1 rounded text-xs">${response.registration.ticket_number}</code>
                            </div>
                        </div>
                    `);
                    checkInModal.modal('show');
                });
            }).fail(function() {
                toastr.error('Error loading ticket details');
            });
        }

        // Clean up scanner when leaving page
        $(window).on('beforeunload', function() {
            if (scannerActive) {
                Quagga.stop();
            }
        });
    });
</script>
@endpush

@push('styles')
<style>
    #scanner-container {
        position: relative;
        margin: 0 auto;
    }

    .ticket-details {
        background: white;
        border-radius: 12px;
    }

    /* Scanner overlay animation */
    #scanner-container .absolute div {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 0.4;
        }
        50% {
            opacity: 1;
        }
    }

    /* Enhanced button hover effects */
    button:hover, a:hover {
        transform: translateY(-2px);
    }

    /* Modal enhancements */
    .modal-content {
        backdrop-filter: blur(10px);
    }
</style>
@endpush
