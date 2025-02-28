<!-- resources/views/emails/contact.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        /* Mengatur warna latar belakang dan margin */
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            border: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .email-footer {
            font-size: 12px;
            color: #888;
            text-align: center;
            margin-top: 20px;
        }
        .email-header {
            display: flex;
            justify-content: center; /* Menyusun elemen secara horizontal di tengah */
            align-items: center; /* Menyusun elemen secara vertikal di tengah */
            width: 100%; /* Membuat elemen mengambil seluruh lebar kontainer */
            padding: 10px; /* Tambahkan padding jika diperlukan */
        }

        .email-header img {
            margin-right: 5px; /* Memberikan jarak antara gambar dan teks */
            max-height: 45px;
        }

        .sitename {
            font-size: 2rem; /* Ukuran font untuk h1, sesuaikan sesuai keinginan */
            font-weight: bold; /* Menebalkan font */
            text-align: left; /* Teks di h1 rata kiri */
        }

        .sitename span {
            color: #1e90ff; /* Warna untuk tag <span> jika perlu */
        }

        .email-body {
          margin: 20px 0 20px 0;
        }
        .quote {
            font-style: italic;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="email-container">
            <!-- Logo -->
            <div class="email-header">
                <img src={{ asset('assets/img/logo-STA-140x211.png') }} alt="Company Logo">
                <h1 class="sitename">Estate<span>Agency</span></h1>
            </div>

            <!-- Pesan dari Form -->
            <div class="email-body">
                <!-- <h2 class="text-primary">Message from Contact Form</h2>
                <p><strong>Message:</strong></p> -->
                <p>{{ $messageContent }}</p>
            </div>

            <!-- Quote -->
            <div class="email-footer">
                <p class="quote">"Pengiriman dari website"</p>
            </div>
        </div>
    </div>
</body>
</html>
