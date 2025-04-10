<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            background: #fff;
            padding: 20px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 30%;
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .content {
            font-size: 16px;
            padding: 10px 20px;
        }

        .content p {
            margin: 10px 0;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #555;
            padding-top: 15px;
            border-top: 1px solid #ddd;
        }

        .highlight {
            font-weight: bold;
            color: #000;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <img src="{{ asset('frontend/assets/images/home/logo.png') }}" alt="OKE" class="logo">
        </div>

        <!-- Content Section -->
        <div class="content">
            <h2 style="text-align: center;">New Job Request</h2>
            <p><strong>Name:</strong> <span class="highlight">{{ $emailData['name'] }}</span></p>
            <p><strong>Email:</strong> <a href="mailto:{{ $emailData['email'] }}">{{ $emailData['email'] }}</a></p>
            <p><strong>Phone:</strong> <a href="tel:{{ $emailData['mobile'] }}">{{ $emailData['mobile'] }}</a></p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <div class="copyright">© {{ date('Y') }} OKE. All rights reserved.</div>
        </div>
    </div>

</body>
</html>
