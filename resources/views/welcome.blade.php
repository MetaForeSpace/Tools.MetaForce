<!DOCTYPE html>
<html lang="en" style="width: 100%; height: 100%; overflow: hidden;">
<head>
    <title>Meta Force QR Code</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .spinner {
            position: fixed;
            top: 50%;
            left: 50%;
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            z-index: 1000;
            margin-left: -60px;
            margin-top: -260px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .content {
            display: none;
        }
        .hidden {
            display: none;
        }
    </style>
    <link rel="icon" type="image/png" sizes="32x32" href="https://meta-force.space/icons/favicon-32x32.png">
    <link href="{{ asset('bootstrap5.css') }}">
</head>
<div id="spinner" class="spinner">
    <div class="spinner-grow text-muted"></div>
    <div class="spinner-grow text-primary"></div>
    <div class="spinner-grow text-success"></div>
    <div class="spinner-grow text-info"></div>
    <div class="spinner-grow text-warning"></div>
    <div class="spinner-grow text-danger"></div>
    <div class="spinner-grow text-secondary"></div>
    <div class="spinner-grow text-dark"></div>
    <div class="spinner-grow text-light"></div>
</div>
<body style="background: linear-gradient(#13479c, #2f0c6c) no-repeat; background-size: cover; overflow: hidden;">
<div id="content" class="content" style="text-align: center">
    <h1 style="color: aliceblue">Meta Force QR Code</h1>
    <img alt="QR-Code" src="{{url('/get-qrcode?str=https://meta-force.space')}}">
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const spinner = document.getElementById('spinner');
        const content = document.getElementById('content');

        window.addEventListener('load', function() {
            spinner.classList.add('hidden');
            content.style.display = 'block';
        });
    });
</script>
</body>
</html>
