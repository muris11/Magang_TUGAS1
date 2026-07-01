<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="">
    <title>Fix Session</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: -apple-system, sans-serif; background: #FDFBF9; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; }
        .card { background: white; border-radius: 24px; padding: 48px; max-width: 480px; width: 100%; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 4px 24px rgba(0,0,0,0.04); }
        h1 { font-size: 28px; margin-bottom: 12px; letter-spacing: -0.04em; }
        p { color: rgba(0,0,0,0.6); line-height: 1.6; margin-bottom: 16px; }
        ol { padding-left: 20px; margin-bottom: 24px; }
        li { color: rgba(0,0,0,0.7); line-height: 1.8; }
        code { background: rgba(0,0,0,0.05); padding: 2px 6px; border-radius: 4px; font-size: 13px; }
        .btn { display: inline-block; background: black; color: white; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: 600; margin-top: 8px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Session Dihapus</h1>
        <p>Semua session & cache telah dibersihkan dari server. Sekarang bersihkan cache browser:</p>
        <ol>
            <li>Tekan <code>Ctrl + Shift + Delete</code></li>
            <li>Pilih "Cookies" dan "Cache"</li>
            <li>Clear, lalu kembali ke halaman ini</li>
        </ol>
        <p>Atau coba langsung login — browser akan auto-refresh cookie.</p>
        <a href="/login" class="btn">Ke Halaman Login</a>
    </div>
    <script>
        // Best-effort: clear this site's storage & cookies
        try { localStorage.clear(); sessionStorage.clear(); } catch (e) {}
        document.cookie.split(';').forEach(c => {
            const eq = c.indexOf('=');
            const name = (eq > -1 ? c.substr(0, eq) : c).trim();
            document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;';
            document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;domain=' + location.hostname + ';';
        });
    </script>
</body>
</html>
