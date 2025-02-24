<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header dengan Logo Profil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Link ke Font Awesome -->
    <!-- Link ke Font Awesome -->
    <style>
        /* Style the header with a grey background and some padding */
        .header {
            overflow: hidden;
            background-color: #f1f1f1;
            padding: 20px 10px;
            position: fixed; /* Membuat header tetap di atas */
            top: 0; /* Menempatkan header di bagian atas */
            width: 100%; /* Lebar header 100% */
            z-index: 1000; /* Menempatkan header di atas elemen lainnya */
        }
        
        /* Style the header links */
        .header a {
            float: left;
            color: black;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            line-height: 25px;
            border-radius: 4px;
        }
        
        /* Style the logo link */
        .header a.logo {
            font-size: 25px;
            font-weight: bold;
        }
        
        /* Change the background color on mouse-over */
        .header a:hover {
            background-color: #ddd;
            color: black;
        }
        
        /* Style the active/current link */
        .header a.active {
            background-color: dodgerblue;
            color: white;
        }
        
        /* Float the link section to the right */
        .header-right {
            float: right;
        }

        /* Logo profil */
        .profile-icon {
            float: right;
            margin-left: 10px; /* Jarak antara logo profil dan link lainnya */
            font-size: 20px; /* Ukuran ikon profil */
            color: black; /* Warna ikon profil */
        }

        /* Add media queries for responsiveness */
        @media screen and (max-width: 500px) {
            .header a {
                float: none;
                display: block;
                text-align: left;
            }
            .header-right {
                float: none;
            }
        }

        /* Konten untuk menguji scroll */
        .content {
            padding: 80px 10px; /* Padding untuk menghindari konten tertutup oleh header */
        }
    </style>
</head>
<body>
<div class="header">
        <a href="#default" class="logo">Aplikasi To-Do List</a>

    </div>

    <div class="content">
        <p style="height: 100px;"></p>
    </div>
</body>
</html>