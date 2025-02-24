<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman dengan Footer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Link ke Font Awesome -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1; /* Membuat konten utama mengisi ruang yang tersedia */
            padding: 20px;
        }

        footer {
            background-color: #333; /* Warna latar belakang footer */
            color: white; /* Warna teks footer */
            text-align: center; /* Teks di tengah */
            padding: 10px 0; /* Padding atas dan bawah */
            position: relative; /* Posisi footer */
            bottom: 0; /* Menempatkan footer di bagian bawah */
            width: 100%; /* Lebar footer 100% */
        }

        small {
            font-size: 0.8em; /* Ukuran font kecil */
        }

        .social-icons {
            margin: 10px 0; /* Margin atas dan bawah untuk ikon sosial */
        }

        .social-icons a {
            color: white; /* Warna ikon */
            margin: 0 10px; /* Margin horizontal antar ikon */
            text-decoration: none; /* Menghilangkan garis bawah */
            font-size: 1.5em; /* Ukuran ikon */
        }

        .social-icons a:hover {
            color: #ffcc00; /* Warna saat hover */
        }
    </style>
</head>
<body>
   
    <footer>
        <div class="social-icons">
            <a href="https://www.facebook.com.babanriz" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/babanriz_" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
        </div>
        <p><small>12RPL2 - Baban</small></p>
    </footer>
</body>
</html>