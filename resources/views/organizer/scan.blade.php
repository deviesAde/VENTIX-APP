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
                                           style="max-width: 500px; min-height: 300px;" playsinline></video>
                                    <canvas id="scanner-canvas" class="hidden"></canvas>

                                    <!-- Scanner Overlay -->
                                    <div class="absolute inset-0 pointer-events-none">
                                        <div class="absolute top-4 left-4 w-8 h-8 border-l-4 border-t-4 border-blue-500 rounded-tl-lg"></div>
                                        <div class="absolute top-4 right-4 w-8 h-8 border-r-4 border-t-4 border-blue-500 rounded-tr-lg"></div>
                                        <div class="absolute bottom-4 left-4 w-8 h-8 border-l-4 border-b-4 border-blue-500 rounded-bl-lg"></div>
                                        <div class="absolute bottom-4 right-4 w-8 h-8 border-r-4 border-b-4 border-blue-500 rounded-br-lg"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Camera Selection -->
                            <div id="camera-selection" class="mb-4 hidden">
                                <label for="camera-select" class="block text-sm font-medium text-gray-700 mb-1">Select Camera:</label>
                                <select id="camera-select" class="block w-full max-w-xs mx-auto rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Loading cameras...</option>
                                </select>
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

                            <!-- Camera Permission Status -->
                            <div id="camera-status" class="mt-4 text-sm text-red-600 hidden">
                                <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                <span id="camera-status-message">Camera access is required for scanning</span>
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
<div class="fixed z-50 inset-0 overflow-y-auto hidden" id="checkInModal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" id="modalBackdrop"></div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-white" id="modal-title">
                        <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Confirm Check-In
                    </h3>
                    <button type="button" class="text-white hover:text-gray-200 focus:outline-none" id="closeModal">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="bg-white px-6 py-4">
                <div class="text-center mb-4">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <p class="text-lg font-medium text-gray-800 mb-2">Ready to check in this attendee?</p>
                </div>
                <div id="attendee-details" class="bg-gray-50 rounded-xl p-4 mb-4"></div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-end rounded-b-2xl">
                <button type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-6 rounded-xl transition-all duration-200 mr-2" id="cancelCheckIn">
                    Cancel
                </button>
                <button type="button" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold py-2 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200" id="confirmCheckIn">
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
<script src="https://cdn.jsdelivr.net/npm/@zxing/library@latest"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scannerElement = document.getElementById('scanner');
        const startButton = document.getElementById('start-scanner');
        const stopButton = document.getElementById('stop-scanner');
        const ticketInfo = document.getElementById('ticket-info');
        const checkInModal = document.getElementById('checkInModal');
        const modalBackdrop = document.getElementById('modalBackdrop');
        const closeModal = document.getElementById('closeModal');
        const cancelCheckIn = document.getElementById('cancelCheckIn');
        const confirmCheckIn = document.getElementById('confirmCheckIn');
        const cameraSelect = document.getElementById('camera-select');
        const cameraSelection = document.getElementById('camera-selection');
        const cameraStatus = document.getElementById('camera-status');

        let currentRegistration = null;
        let codeReader = null;
        let selectedDeviceId = null;
        let scanningActive = false;
        let scannerTimeout = null;

        // Initialize the scanner
        function initScanner() {
            codeReader = new ZXing.BrowserQRCodeReader();

            // Check for camera permissions first
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(() => {
                    // User granted permission, now list cameras
                    return codeReader.listVideoInputDevices();
                })
                .then(videoInputDevices => {
                    if (videoInputDevices.length > 0) {
                        cameraSelection.classList.remove('hidden');
                        cameraSelect.innerHTML = '';

                        videoInputDevices.forEach((device, index) => {
                            const option = document.createElement('option');
                            option.value = device.deviceId;
                            option.text = device.label || `Camera ${index + 1}`;
                            cameraSelect.appendChild(option);
                        });

                        // Default to the environment-facing camera if available
                        const backCamera = videoInputDevices.find(device =>
                            device.label.toLowerCase().includes('back') ||
                            device.label.toLowerCase().includes('environment')
                        );

                        if (backCamera) {
                            cameraSelect.value = backCamera.deviceId;
                        }

                        // Auto-start the scanner if we have cameras
                        startScanner();
                    } else {
                        showCameraError('No cameras found');
                    }
                })
                .catch(err => {
                    console.error('Error initializing scanner:', err);
                    showCameraError('Camera access denied. Please enable camera permissions.');
                });
        }

        // Start scanner
        async function startScanner() {
            if (scanningActive) return;

            try {
                selectedDeviceId = cameraSelect.value || undefined;

                // Reset camera status
                cameraStatus.classList.add('hidden');
                cameraStatus.textContent = '';

                // Show loading state
                startButton.disabled = true;
                startButton.querySelector('span').textContent = 'Starting...';

                // Clear any previous video streams
                if (scannerElement.srcObject) {
                    scannerElement.srcObject.getTracks().forEach(track => track.stop());
                    scannerElement.srcObject = null;
                }

                await codeReader.decodeFromVideoDevice(selectedDeviceId, scannerElement, (result, error) => {
                    if (result) {
                        handleScanResult(result.text);
                    }

                    if (error) {
                        if (error.name !== 'NotFoundException') {
                            console.error('Scan error:', error);
                        }
                    }
                });

                scanningActive = true;
                startButton.classList.add('hidden');
                stopButton.classList.remove('hidden');

                // Hide camera selection while scanning
                cameraSelection.classList.add('hidden');

                // Make sure video is playing
                scannerElement.play().catch(err => {
                    console.error('Error playing video:', err);
                    showCameraError('Could not start video stream');
                    stopScanner();
                });
            } catch (error) {
                console.error('Error starting scanner:', error);
                showCameraError('Could not access camera. Please check permissions.');
                stopScanner();
            } finally {
                startButton.disabled = false;
                startButton.querySelector('span').textContent = 'Start Scanner';
            }
        }

        // Stop scanner
        async function stopScanner() {
            if (!scanningActive) return;

            try {
                await codeReader.reset();
                scanningActive = false;
                startButton.classList.remove('hidden');
                stopButton.classList.add('hidden');

                // Show camera selection again
                cameraSelection.classList.remove('hidden');

                // Clear video stream
                if (scannerElement.srcObject) {
                    scannerElement.srcObject.getTracks().forEach(track => track.stop());
                    scannerElement.srcObject = null;
                }

                // Clear any pending timeouts
                if (scannerTimeout) {
                    clearTimeout(scannerTimeout);
                    scannerTimeout = null;
                }
            } catch (error) {
                console.error('Error stopping scanner:', error);
            }
        }

        function handleScanResult(code) {
            // Stop scanner immediately after successful scan
            stopScanner();

            try {
                // Verify the ticket
                fetch('{{ route("organizer.scan.verify") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ ticket_data: code })
                })
                .then(response => response.json())
                .then(response => {
                    if (response.success) {
                        currentRegistration = response.registration;
                        loadTicketInfo(response.registration.id);
                    } else {
                        showToast('error', response.message);
                        // Restart scanner after error
                        scannerTimeout = setTimeout(() => startScanner(), 2000);
                    }
                })
                .catch(error => {
                    console.error('Error verifying ticket:', error);
                    showToast('error', 'Error verifying ticket');
                    // Restart scanner after error
                    scannerTimeout = setTimeout(() => startScanner(), 2000);
                });
            } catch (e) {
                showToast('error', 'Invalid QR code format');
                // Restart scanner after error
                scannerTimeout = setTimeout(() => startScanner(), 2000);
            }
        }

        function loadTicketInfo(registrationId) {
            fetch(`/organizer/registrations/${registrationId}`)
                .then(response => response.json())
                .then(response => {
                    const statusColor = response.registration.status === 'confirmed' ?
                        'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
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

                    ticketInfo.innerHTML = `
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
                    `;

                    // Set up check-in button
                    document.querySelector('.check-in-btn')?.addEventListener('click', function() {
                        document.getElementById('attendee-details').innerHTML = `
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
                        `;
                        openModal();
                    });
                })
                .catch(error => {
                    console.error('Error loading ticket details:', error);
                    showToast('error', 'Error loading ticket details');
                    // Restart scanner after error
                    scannerTimeout = setTimeout(() => startScanner(), 2000);
                });
        }

        function showCameraError(message) {
            cameraStatus.classList.remove('hidden');
            cameraStatus.querySelector('#camera-status-message').textContent = message;
        }

        function showToast(type, message) {
            // Simple toast notification
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white font-medium ${
                type === 'error' ? 'bg-red-500' : 'bg-green-500'
            }`;
            toast.textContent = message;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        function openModal() {
            checkInModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModalFunc() {
            checkInModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            // Restart scanner after modal is closed
            scannerTimeout = setTimeout(() => startScanner(), 500);
        }

        // Event listeners
        startButton.addEventListener('click', startScanner);
        stopButton.addEventListener('click', stopScanner);
        cameraSelect.addEventListener('change', function() {
            if (scanningActive) {
                stopScanner().then(() => startScanner());
            }
        });
        closeModal.addEventListener('click', closeModalFunc);
        modalBackdrop.addEventListener('click', closeModalFunc);
        cancelCheckIn.addEventListener('click', closeModalFunc);

        confirmCheckIn.addEventListener('click', function() {
            if (!currentRegistration) return;

            fetch('{{ route("organizer.scan.check-in") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    registration_id: currentRegistration.id
                })
            })
            .then(response => response.json())
            .then(response => {
                if (response.success) {
                    showToast('success', response.message);
                    loadTicketInfo(currentRegistration.id);
                    closeModalFunc();
                } else {
                    showToast('error', response.message);
                }
            })
            .catch(error => {
                console.error('Error during check-in:', error);
                showToast('error', 'An error occurred during check-in');
            });
        });

        // Initialize scanner when page loads
        initScanner();

        // Clean up scanner when leaving page
        window.addEventListener('beforeunload', function() {
            if (scanningActive) {
                stopScanner();
            }
        });

        // Handle escape key to close modal
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !checkInModal.classList.contains('hidden')) {
                closeModalFunc();
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
    #checkInModal {
        transition: opacity 0.3s ease;
    }

    /* Video element styling */
    #scanner {
        background-color: #f3f4f6;
        object-fit: cover;
    }

    /* Camera selection dropdown */
    #camera-select {
        transition: all 0.2s;
    }

    #camera-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }

    /* Modal transitions */
    .modal-transition {
        transition: all 0.3s ease-out;
    }

    .modal-enter {
        opacity: 0;
        transform: translateY(-10px);
    }

    .modal-enter-active {
        opacity: 1;
        transform: translateY(0);
    }

    .modal-exit {
        opacity: 1;
    }

    .modal-exit-active {
        opacity: 0;
        transform: translateY(-10px);
    }
</style>
@endpush
