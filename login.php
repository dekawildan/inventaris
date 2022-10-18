<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <link rel="manifest" href="manifest.json"/>
    <link rel="shortcut icon" href="img/logorpl.png" type="image/png">
    <link rel="apple-touch-icon" href="img/logorpl.png" type="image/png">
</head>
<body>

    <!-- Desain Header Login-->
    <div class="atas">
        <h2 style="text-align: center;">Halaman Login</h2>
    </div>

    <!-- Desain isi login -->
    <div class="isi">

        <!-- Form login -->
        <form method="post" action="cek-login.php">
                <input type="text" name="username" placeholder="Username..." autofocus required>
                <input type="password" name="password" placeholder="Password..." required>
                <button type="submit" name="masuk">Masuk</button>
        </form>
    </div>

    <!-- Desain footer login -->
    <div class="bawah">
        <p style="text-align: center;"><strong>Aplikasi Inventaris</strong></p>
    </div>
    
    <script>
            var BASE_URL = 'https://inventarisbhinus.000webhostapp.com/';
            document.addEventListener('DOMContentLoaded', init, false);

            function init() {
                if ('serviceWorker' in navigator && navigator.onLine) {
                    navigator.serviceWorker.register( BASE_URL + 'service-worker.js')
                    .then((reg) => {
                        console.log('Registrasi service worker Berhasil', reg);
                    }, (err) => {
                        console.error('Registrasi service worker Gagal', err);
                    });
                }
            }
</script>
</body>
</html>