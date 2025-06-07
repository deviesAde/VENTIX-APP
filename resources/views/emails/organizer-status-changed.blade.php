<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran Organizer</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .header {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            padding: 30px;
            color: white;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .header-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .header-subtitle {
            font-size: 14px;
            opacity: 0.9;
        }

        .content {
            padding: 30px;
        }

        .greeting {
            margin-bottom: 25px;
        }

        .greeting h2 {
            font-size: 20px;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .organization-name {
            color: #3b82f6;
            font-weight: 600;
        }

        .status-line {
            color: #6b7280;
            font-size: 16px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-left: 8px;
            text-transform: capitalize;
        }

        .status-approved {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .status-rejected {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .status-pending {
            background: #fefce8;
            color: #ca8a04;
            border: 1px solid #fde68a;
        }

        .status-message {
            margin: 25px 0;
        }

        .alert {
            padding: 20px;
            border-radius: 12px;
            border: 1px solid;
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .alert-success {
            background: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
        }

        .alert-error {
            background: #fef2f2;
            border-color: #fecaca;
            color: #dc2626;
        }

        .alert-icon {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .alert-content h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .alert-content p {
            font-size: 15px;
            line-height: 1.5;
        }

        .footer {
            border-top: 1px solid #e5e7eb;
            padding-top: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-text {
            color: #1f2937;
        }

        .footer-text .company {
            color: #3b82f6;
            font-weight: 600;
            font-size: 18px;
        }

        .footer-logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
        }

        .info-content {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #6b7280;
            font-size: 14px;
        }

        .info-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        @media (max-width: 640px) {
            body {
                padding: 10px;
            }

            .header {
                padding: 20px;
            }

            .content {
                padding: 20px;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .footer {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Card -->
        <div class="card">
            <div class="header">
                <div class="header-content">
                    <div class="header-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1>Status Pendaftaran</h1>
                        <div class="header-subtitle">Update untuk organizer</div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="content">
                <div class="greeting">
                    <h2>Halo, <span class="organization-name">{{ $organizer->organization_name }}</span></h2>
                    <p class="status-line">
                        Status pendaftaran Anda telah diperbarui menjadi:
                        <span class="status-badge {{ $status === 'approved' ? 'status-approved' : ($status === 'rejected' ? 'status-rejected' : 'status-pending') }}">
                            {{ ucfirst($status) }}
                        </span>
                    </p>
                </div>

                <!-- Status Message -->
                <div class="status-message">
                    @if($status === 'approved')
                        <div class="alert alert-success">
                            <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="alert-content">
                                <h3>Selamat! 🎉</h3>
                                <p>Akun Anda telah disetujui. Anda sekarang dapat menggunakan platform kami sebagai organizer.</p>
                            </div>
                        </div>
                    @elseif($status === 'rejected')
                        <div class="alert alert-error">
                            <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <div class="alert-content">
                                <h3>Pendaftaran Ditolak</h3>
                                <p>Mohon maaf, pendaftaran Anda telah ditolak. Jika Anda memiliki pertanyaan, silakan hubungi tim kami.</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Footer -->
                <div class="footer">
                    <div class="footer-text">
                        <p>Terima kasih,</p>
                        <p class="company">Tim Ventix</p>
                    </div>
                    <div class="footer-logo">
                        V
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Info Card -->
        <div class="info-card">
            <div class="info-content">
                <svg class="info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p>Email ini dikirim secara otomatis. Harap jangan membalas email ini.</p>
            </div>
        </div>
    </div>
</body>
</html>
