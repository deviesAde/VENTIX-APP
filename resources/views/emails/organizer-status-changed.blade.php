<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Status Pendaftaran Organizer</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #2d3748;
            padding: 40px 20px;
            min-height: 100vh;
            line-height: 1.6;
        }

        .email-wrapper {
            max-width: 650px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        .email-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ff6b6b, #feca57, #48dbfb, #ff9ff3);
        }

        .container {
            padding: 48px 40px;
            position: relative;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #ff6b6b, #ff5252);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
        }

        .header-icon svg {
            width: 40px;
            height: 40px;
            fill: white;
        }

        .header-title {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .header-subtitle {
            font-size: 16px;
            color: #718096;
        }

        .content {
            margin-bottom: 40px;
        }

        .greeting {
            font-size: 18px;
            color: #4a5568;
            margin-bottom: 24px;
            font-weight: 500;
        }

        .status-approved {
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
            padding: 24px;
            border-radius: 16px;
            margin-bottom: 32px;
            box-shadow: 0 8px 25px rgba(72, 187, 120, 0.3);
        }

        .status-rejected {
            background: linear-gradient(135deg, #f56565, #e53e3e);
            color: white;
            padding: 24px;
            border-radius: 16px;
            margin-bottom: 32px;
            box-shadow: 0 8px 25px rgba(245, 101, 101, 0.3);
        }

        .status-approved h3,
        .status-rejected h3 {
            font-size: 20px;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .status-approved p,
        .status-rejected p {
            font-size: 16px;
            opacity: 0.95;
        }

        .info-card {
            background: #f7fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            margin: 24px 0;
        }

        .info-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
        }

        .info-title svg {
            width: 20px;
            height: 20px;
            margin-right: 8px;
            fill: #4299e1;
        }

        .info-list {
            list-style: none;
            padding: 0;
        }

        .info-list li {
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
        }

        .info-list li:last-child {
            border-bottom: none;
        }

        .info-list strong {
            color: #4a5568;
            min-width: 80px;
            margin-right: 12px;
        }

        .info-list span {
            color: #2d3748;
            font-weight: 500;
        }

        .button {
            display: inline-block;
            background: linear-gradient(135deg, #ff6b6b, #ff5252);
            color: white;
            padding: 16px 32px;
            border-radius: 50px;
            text-decoration: none;
            margin-top: 24px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
            transition: all 0.3s ease;
            text-align: center;
            display: inline-flex;
            align-items: center;
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(255, 107, 107, 0.5);
        }

        .button svg {
            width: 20px;
            height: 20px;
            margin-left: 8px;
            fill: currentColor;
        }

        .footer {
            text-align: center;
            padding: 32px 40px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            margin: 0 -40px -48px -40px;
        }

        .footer-content {
            font-size: 14px;
            color: #718096;
            line-height: 1.8;
        }

        .footer-signature {
            font-weight: 600;
            color: #4a5568;
            margin-top: 8px;
        }

        .decorative-dots {
            text-align: center;
            margin: 32px 0;
        }

        .decorative-dots span {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #cbd5e0;
            margin: 0 4px;
        }

        .decorative-dots span:nth-child(2) {
            background: #a0aec0;
        }

        .decorative-dots span:nth-child(3) {
            background: #718096;
        }

        @media (max-width: 640px) {
            body {
                padding: 20px 10px;
            }

            .container {
                padding: 32px 24px;
            }

            .header-title {
                font-size: 24px;
            }

            .footer {
                padding: 24px;
                margin: 0 -24px -32px -24px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="container">
            <div class="header">
                <div class="header-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2L2 7V10C2 16 6 20.5 12 22C18 20.5 22 16 22 10V7L12 2Z"/>
                    </svg>
                </div>
                <h1 class="header-title">Status Pendaftaran</h1>
                <p class="header-subtitle">Event Organizer Platform</p>
            </div>

            <div class="content">
                <p class="greeting">Halo <strong>{{ $organizer->organization_name }}</strong>,</p>

                @if ($status === 'approved')
                    <div class="status-approved">
                        <h3>🎉 Selamat! Pendaftaran Disetujui</h3>
                        <p>Pendaftaran Anda sebagai Event Organizer telah berhasil disetujui. Selamat bergabung dengan platform kami!</p>
                    </div>

                    <div class="info-card">
                        <div class="info-title">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM13 17H11V15H13V17ZM13 13H11V7H13V13Z"/>
                            </svg>
                            Informasi Akun Anda
                        </div>
                        <ul class="info-list">
                            <li>
                                <strong>Email:</strong>
                                <span>{{ $organizer->email }}</span>
                            </li>
                            @if ($password)
                                <li>
                                    <strong>Password:</strong>
                                    <span>{{ $password }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <p>Silakan login melalui tombol di bawah ini untuk mulai menggunakan sistem kami dan mengelola event Anda:</p>

                    <div style="text-align: center;">
                        <a href="{{ route('login') }}" class="button">
                            Login Sekarang
                            <svg viewBox="0 0 24 24">
                                <path d="M10 17L15 12L10 7V17Z"/>
                            </svg>
                        </a>
                    </div>

                @elseif ($status === 'rejected')
                    <div class="status-rejected">
                        <h3>😔 Pendaftaran Tidak Disetujui</h3>
                        <p>Mohon maaf, pendaftaran Anda sebagai Event Organizer tidak dapat disetujui pada saat ini.</p>
                    </div>

                    <p>Jika Anda merasa ini adalah kesalahan atau ingin mengajukan kembali, silakan hubungi tim kami untuk informasi lebih lanjut.</p>
                @endif

                <div class="decorative-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="footer-content">
                Terima kasih atas kepercayaan Anda pada platform kami.<br>
                Jika ada pertanyaan, jangan ragu untuk menghubungi tim support kami.
            </div>
            <div class="footer-signature">
                Tim Admin Event Platform
            </div>
        </div>
    </div>
</body>
</html>
