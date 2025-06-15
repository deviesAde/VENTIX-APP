@extends('layouts.organizer')

@section('title', 'Scan Ticket')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-pink-400 to-pink-500 px-6 py-8">
                <h1 class="text-3xl font-bold text-white">
                    <svg class="inline-block w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1zm12 0h2a1 1 0 001-1V6a1 1 0 00-1-1h-2a1 1 0 00-1 1v1a1 1 0 001 1zM5 20h2a1 1 0 001-1v-1a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1z"></path>
                    </svg>
                    Scan Ticket
                </h1>
                <p class="text-pink-100 mt-2">Scan QR codes or enter ticket codes manually to verify attendee check-ins</p>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Scanner Section -->
                    <div class="space-y-6">
                        <!-- Camera Scanner -->
                        <div class="bg-gray-900 rounded-lg overflow-hidden">
                            <div id="scanner-container" class="relative">
                                <video id="scanner" class="w-full h-64 object-cover bg-gray-800"></video>
                                <div class="absolute inset-0 border-2 border-dashed border-pink-400 m-4 rounded-lg pointer-events-none opacity-50"></div>
                                <div class="absolute top-4 left-4 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm">
                                    <span class="w-2 h-2 bg-green-400 rounded-full inline-block mr-2 animate-pulse"></span>
                                    Camera Active
                                </div>
                            </div>
                        </div>

                        <!-- Manual Input -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Or enter ticket code manually:
                            </label>
                            <div class="flex space-x-2">
                                <input type="text"
                                       id="manual-ticket-input"
                                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-colors"
                                       placeholder="Enter ticket code...">
                                <button id="manual-check-btn"
                                        class="px-6 py-3 bg-pink-500 text-white rounded-lg hover:bg-pink-600 focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition-all duration-200 font-medium">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Image Upload Section -->
                        <div id="image-upload-section" class="hidden">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <h3 class="text-sm font-medium text-blue-800 mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Upload Proof of Attendance (Optional)
                                </h3>

                                <div class="border-2 border-dashed border-blue-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-colors"
                                     id="drop-area">
                                    <svg class="mx-auto h-12 w-12 text-blue-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <div class="text-sm text-blue-600">
                                        <p id="file-label" class="font-medium">Click to upload or drag and drop</p>
                                        <p class="text-blue-500 mt-1">PNG, JPG up to 2MB</p>
                                    </div>
                                    <input id="proof-image" type="file" class="hidden" accept="image/*">
                                </div>

                                <div id="image-preview" class="mt-4 hidden">
                                    <div class="relative inline-block">
                                        <img id="preview-image" class="h-24 w-24 object-cover rounded-lg border-2 border-blue-200">
                                        <div class="absolute -top-2 -right-2 bg-green-500 text-white rounded-full p-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Results Section -->
                    <div class="lg:border-l lg:border-gray-200 lg:pl-8">
                        <div id="result-section" class="hidden">
                            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-6 border border-green-200">
                                <h3 class="text-xl font-semibold text-green-800 mb-6 flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Ticket Information
                                </h3>

                                <div class="space-y-6">
                                    <!-- QR Code -->
                                    <div class="flex justify-center" id="qr-code-container">
                                        <!-- QR code will be inserted here -->
                                    </div>

                                    <!-- Ticket Details -->
                                    <div class="bg-white rounded-lg p-4 shadow-sm">
                                        <div id="ticket-details" class="space-y-3">
                                            <!-- Ticket details will be inserted here -->
                                        </div>
                                    </div>

                                    <!-- Proof Image -->
                                    <div id="proof-image-container" class="text-center">
                                        <!-- Proof image will be inserted here -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Placeholder when no ticket scanned -->
                        <div id="placeholder-section" class="text-center py-12">
                            <div class="bg-gray-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1zm12 0h2a1 1 0 001-1V6a1 1 0 00-1-1h-2a1 1 0 00-1 1v1a1 1 0 001 1zM5 20h2a1 1 0 001-1v-1a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Ready to Scan</h3>
                            <p class="text-gray-500">Point your camera at a QR code or enter a ticket code manually</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success/Error Modal -->
<div id="success-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all">
        <div class="p-6 text-center">
            <div id="modal-icon" class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center bg-green-100">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 id="success-title" class="text-xl font-semibold text-gray-900 mb-2"></h3>
            <p id="success-message" class="text-gray-600 mb-6"></p>
            <button id="close-modal"
                    class="px-6 py-3 bg-pink-500 text-white rounded-lg hover:bg-pink-600 focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition-all duration-200 font-medium">
                Close
            </button>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-40">
    <div class="bg-white rounded-lg p-6 text-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-pink-500 mx-auto mb-4"></div>
        <p class="text-gray-600">Processing ticket...</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/instascan@1.0.0/dist/instascan.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const elements = {
        scannerContainer: document.getElementById('scanner-container'),
        resultSection: document.getElementById('result-section'),
        placeholderSection: document.getElementById('placeholder-section'),
        manualInput: document.getElementById('manual-ticket-input'),
        manualCheckBtn: document.getElementById('manual-check-btn'),
        imageUploadSection: document.getElementById('image-upload-section'),
        proofImageInput: document.getElementById('proof-image'),
        fileLabel: document.getElementById('file-label'),
        imagePreview: document.getElementById('image-preview'),
        previewImage: document.getElementById('preview-image'),
        dropArea: document.getElementById('drop-area'),
        successModal: document.getElementById('success-modal'),
        successTitle: document.getElementById('success-title'),
        successMessage: document.getElementById('success-message'),
        closeModal: document.getElementById('close-modal'),
        qrCodeContainer: document.getElementById('qr-code-container'),
        ticketDetails: document.getElementById('ticket-details'),
        proofImageContainer: document.getElementById('proof-image-container'),
        loadingOverlay: document.getElementById('loading-overlay'),
        modalIcon: document.getElementById('modal-icon')
    };

    let scanner = null;
    let currentTicketCode = '';

    // Initialize QR Code Scanner
    function initScanner() {
        Instascan.Camera.getCameras()
            .then(function(cameras) {
                if (cameras.length > 0) {
                    scanner = new Instascan.Scanner({
                        video: document.getElementById('scanner'),
                        mirror: false
                    });

                    scanner.addListener('scan', function(content) {
                        currentTicketCode = content;
                        showImageUploadSection();
                        elements.manualInput.value = content;
                    });

                    scanner.start(cameras[0]);
                } else {
                    showCameraError('No camera found. Please use manual input.');
                }
            })
            .catch(function(error) {
                console.error('Camera error:', error);
                showCameraError(`Camera access error: ${error.message}`);
            });
    }

    function showCameraError(message) {
        elements.scannerContainer.innerHTML = `
            <div class="h-64 bg-yellow-50 border-2 border-yellow-200 rounded-lg flex items-center justify-center">
                <div class="text-center">
                    <svg class="w-12 h-12 text-yellow-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 14c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    <p class="text-yellow-800 font-medium">${message}</p>
                </div>
            </div>
        `;
    }

    function showImageUploadSection() {
        elements.imageUploadSection.classList.remove('hidden');
    }

    function showLoading() {
        elements.loadingOverlay.classList.remove('hidden');
    }

    function hideLoading() {
        elements.loadingOverlay.classList.add('hidden');
    }

    // Verify Ticket
    function verifyTicket(ticketCode) {
        if (!ticketCode.trim()) {
            showError('Invalid Input', 'Please enter a valid ticket code.');
            return;
        }

        showLoading();

        const formData = new FormData();
        formData.append('ticket_code', ticketCode);

        if (elements.proofImageInput.files[0]) {
            formData.append('proof_image', elements.proofImageInput.files[0]);
        }

        fetch("{{ route('organizer.verify-ticket') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            hideLoading();

            if (data.status === 'success') {
                showSuccess('Check-in Successful!', 'Ticket verified and attendance recorded.');
                displayTicketInfo(data.data);
            } else if (data.status === 'warning') {
                showWarning('Ticket Already Used', 'This ticket was already checked in.');
                displayTicketInfo(data.data);
            } else {
                showError('Invalid Ticket', data.message || 'Error verifying ticket.');
            }
        })
        .catch(error => {
            hideLoading();
            showError('Network Error', 'An error occurred while processing the ticket.');
            console.error('Error:', error);
        });
    }

    // Display Ticket Information
    function displayTicketInfo(data) {
        elements.resultSection.classList.remove('hidden');
        elements.placeholderSection.classList.add('hidden');

        // Display QR Code
        elements.qrCodeContainer.innerHTML = `
            <div class="bg-white p-4 rounded-lg shadow-sm border">
                <img src="${data.qr_code}" alt="QR Code" class="w-32 h-32 mx-auto">
            </div>
        `;

        // Display Ticket Details
        const ticketInfo = [
            { label: 'Attendee', value: data.user.name, icon: 'user' },
            { label: 'Email', value: data.user.email, icon: 'mail' },
            { label: 'Event', value: data.event.title, icon: 'calendar' },
            { label: 'Ticket Number', value: data.ticket.ticket_number, icon: 'ticket' },
            {
                label: 'Status',
                value: data.ticket.checked_in_at ? 'Checked In' : 'Not Checked In',
                icon: 'check',
                isStatus: true,
                isCheckedIn: !!data.ticket.checked_in_at
            }
        ];

        if (data.ticket.checked_in_at) {
            ticketInfo.push({
                label: 'Check-in Time',
                value: new Date(data.ticket.checked_in_at).toLocaleString(),
                icon: 'clock'
            });
        }

        if (data.remaining_tickets !== null) {
            ticketInfo.push({
                label: 'Remaining Tickets',
                value: data.remaining_tickets,
                icon: 'ticket'
            });
        }

        elements.ticketDetails.innerHTML = ticketInfo.map(info => `
            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                <div class="flex items-center text-gray-600">
                    ${getIcon(info.icon)}
                    <span class="font-medium">${info.label}:</span>
                </div>
                <div class="text-right ${info.isStatus ? (info.isCheckedIn ? 'text-green-600 font-semibold' : 'text-blue-600 font-semibold') : 'text-gray-900'}">
                    ${info.value}
                </div>
            </div>
        `).join('');

        // Display Proof Image
        if (data.proof_image_url) {
            elements.proofImageContainer.innerHTML = `
                <div class="bg-white rounded-lg p-4 shadow-sm border">
                    <h4 class="font-medium text-gray-900 mb-3 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Proof of Attendance
                    </h4>
                    <img src="${data.proof_image_url}" class="h-40 w-auto rounded-lg border border-gray-200 mx-auto shadow-sm">
                </div>
            `;
        } else {
            elements.proofImageContainer.innerHTML = '';
        }
    }

    function getIcon(iconName) {
        const icons = {
            user: '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>',
            mail: '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>',
            calendar: '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>',
            ticket: '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 11-4 0V7a2 2 0 00-2-2H5z"></path></svg>',
            check: '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
            clock: '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
        };
        return icons[iconName] || '';
    }

    // Modal Functions
    function showSuccess(title, message) {
        setModalStyle('success');
        elements.successTitle.textContent = title;
        elements.successMessage.textContent = message;
        elements.successModal.classList.remove('hidden');
    }

    function showWarning(title, message) {
        setModalStyle('warning');
        elements.successTitle.textContent = title;
        elements.successMessage.textContent = message;
        elements.successModal.classList.remove('hidden');
    }

    function showError(title, message) {
        setModalStyle('error');
        elements.successTitle.textContent = title;
        elements.successMessage.textContent = message;
        elements.successModal.classList.remove('hidden');
    }

    function setModalStyle(type) {
        elements.modalIcon.className = 'w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center';

        const styles = {
            success: {
                bgClass: 'bg-green-100',
                iconClass: 'text-green-500',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>'
            },
            warning: {
                bgClass: 'bg-yellow-100',
                iconClass: 'text-yellow-500',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 14c-.77.833.192 2.5 1.732 2.5z"></path>'
            },
            error: {
                bgClass: 'bg-red-100',
                iconClass: 'text-red-500',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>'
            }
        };

        const style = styles[type];
        elements.modalIcon.classList.add(style.bgClass);
        elements.modalIcon.innerHTML = `
            <svg class="w-8 h-8 ${style.iconClass}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${style.icon}
            </svg>
        `;
    }

    // Event Listeners
    elements.closeModal.addEventListener('click', function() {
        elements.successModal.classList.add('hidden');
        resetForm();
    });

    elements.manualCheckBtn.addEventListener('click', function() {
        const ticketCode = elements.manualInput.value.trim();
        if (ticketCode) {
            currentTicketCode = ticketCode;
            showImageUploadSection();
        }
    });

    elements.manualInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const ticketCode = elements.manualInput.value.trim();
            if (ticketCode) {
                currentTicketCode = ticketCode;
                showImageUploadSection();
            }
        }
    });

    // Image Upload Handlers
    elements.proofImageInput.addEventListener('change', function(e) {
        handleImageUpload(e.target.files[0]);
    });

    // Drag and Drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        elements.dropArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        elements.dropArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        elements.dropArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        elements.dropArea.classList.add('border-blue-400', 'bg-blue-100');
    }

    function unhighlight() {
        elements.dropArea.classList.remove('border-blue-400', 'bg-blue-100');
    }

    elements.dropArea.addEventListener('drop', function(e) {
        const file = e.dataTransfer.files[0];
        if (file) {
            elements.proofImageInput.files = e.dataTransfer.files;
            handleImageUpload(file);
        }
    });

    function handleImageUpload(file) {
        if (!file) return;

        // Validate file type
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!validTypes.includes(file.type)) {
            showError('Invalid File Type', 'Only JPG, JPEG or PNG files are allowed.');
            return;
        }

        // Validate file size (2MB max)
        if (file.size > 2 * 1024 * 1024) {
            showError('File Too Large', 'Maximum file size is 2MB.');
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = function(event) {
            elements.previewImage.src = event.target.result;
            elements.imagePreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);

        // Update file label
        elements.fileLabel.innerHTML = `<span class="font-semibold text-blue-600">Selected:</span> ${file.name}`;

        // Auto-verify ticket if code is available
        if (currentTicketCode) {
            verifyTicket(currentTicketCode);
        }
    }

    function resetForm() {
        currentTicketCode = '';
        elements.manualInput.value = '';
        elements.imageUploadSection.classList.add('hidden');
        elements.imagePreview.classList.add('hidden');
        elements.resultSection.classList.add('hidden');
        elements.placeholderSection.classList.remove('hidden');
        elements.fileLabel.innerHTML = '<span class="font-medium">Click to upload or drag and drop</span>';
        elements.proofImageInput.value = '';

        // Clear any file input
        const newFileInput = elements.proofImageInput.cloneNode(true);
        elements.proofImageInput.parentNode.replaceChild(newFileInput, elements.proofImageInput);
        elements.proofImageInput = newFileInput;
        elements.proofImageInput.addEventListener('change', function(e) {
            handleImageUpload(e.target.files[0]);
        });
    }

    // Click handler for drop area
    elements.dropArea.addEventListener('click', function() {
        elements.proofImageInput.click();
    });

    // Initialize scanner on page load
    initScanner();

    // Auto-hide alerts after 5 seconds
    function autoHideModal() {
        setTimeout(function() {
            if (!elements.successModal.classList.contains('hidden')) {
                elements.closeModal.click();
            }
        }, 5000);
    }

    // Override modal show functions to include auto-hide
    const originalShowSuccess = showSuccess;
    const originalShowWarning = showWarning;
    const originalShowError = showError;

    showSuccess = function(title, message) {
        originalShowSuccess(title, message);
        autoHideModal();
    };

    showWarning = function(title, message) {
        originalShowWarning(title, message);
        autoHideModal();
    };

    showError = function(title, message) {
        originalShowError(title, message);
        autoHideModal();
    };

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // ESC to close modal
        if (e.key === 'Escape' && !elements.successModal.classList.contains('hidden')) {
            elements.closeModal.click();
        }

        // Ctrl/Cmd + K to focus on manual input
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            elements.manualInput.focus();
        }
    });

    // Add visual feedback for manual input
    elements.manualInput.addEventListener('input', function() {
        if (this.value.trim()) {
            elements.manualCheckBtn.classList.remove('bg-pink-500', 'hover:bg-pink-600');
            elements.manualCheckBtn.classList.add('bg-green-500', 'hover:bg-green-600');
        } else {
            elements.manualCheckBtn.classList.remove('bg-green-500', 'hover:bg-green-600');
            elements.manualCheckBtn.classList.add('bg-pink-500', 'hover:bg-pink-600');
        }
    });
});
</script>
@endsection
