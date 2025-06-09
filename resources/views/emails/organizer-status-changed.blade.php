<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Status Pendaftaran Organizer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            color: #333;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            padding: 24px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            max-width: 600px;
            margin: auto;
        }
        .header {
            font-size: 20px;
            font-weight: bold;
            color: #ff6b6b;
            margin-bottom: 16px;
        }
        .button {
            display: inline-block;
            background-color: #ff6b6b;
            color: white;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 16px;
        }
        .footer {
            margin-top: 32px;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Status Pendaftaran Organizer</div>

        <p>Halo {{ $organizer->organization_name }},</p>

        @if ($status === 'approved')
            <p>Selamat! Pendaftaran Anda sebagai Event Organizer telah <strong>disetujui</strong>.</p>
            <p>Berikut adalah informasi akun Anda:</p>

            <ul>
                <li><strong>Email:</strong> {{ $organizer->email }}</li>
                @if ($password)
                    <li><strong>Password:</strong> {{ $password }}</li>
                @endif
            </ul>

            <p>Silakan login melalui tombol di bawah ini untuk mulai menggunakan sistem kami:</p>

            <p><a href="{{ route('login') }}" class="button">Login Sekarang</a></p>
        @elseif ($status === 'rejected')
            <p>Mohon maaf, pendaftaran Anda sebagai Event Organizer <strong>tidak disetujui</strong> pada saat ini.</p>
            <p>Jika Anda merasa ini adalah kesalahan atau ingin mengajukan kembali, silakan hubungi tim kami.</p>
        @endif

        <div class="footer">
            Terima kasih,<br>
            Tim Admin Event Platform
        </div>
    </div>
</body>
</html>
