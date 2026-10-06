<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Status Pendaftaran LSP UMLA</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <h2>Halo, {{ $registration->name }}</h2>
    
    <p>Mohon maaf, pendaftaran Anda pada sistem LSP UMLA belum dapat disetujui.</p>
    
    <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 5px; margin: 15px 0;">
        <strong>Alasan Penolakan:</strong><br>
        {{ $note }}
    </div>

    <p>Silakan periksa kembali data atau persyaratan Anda, lalu lakukan pendaftaran ulang jika diperlukan.</p>

    <p>Salam,<br><strong>LSP UMLA</strong></p>
</body>
</html>