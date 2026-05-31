<?php
session_start();
if (isset($_SESSION['id_user'])) {
    header("Location: menu.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MBG</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-card {
            background-color: #ffffff;
            width: 100%;
            max-width: 440px; 
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(2, 132, 199, 0.1);
            position: relative; 
        }

        .header-logo {
            position: absolute;
            top: 40px; 
            left: 40px; 
            width: 60px; 
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .header-text {
            text-align: center;
            margin-bottom: 35px;
            margin-top: 5px; 
        }

        .header-text h1 {
            color: #0284c7; 
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .header-text p {
            color: #64748b;
            font-size: 14px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            color: #334155;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            color: #1e293b;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .input-group input:focus {
            outline: none;
            border-color: #38bdf8;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.15);
        }

        .btn-masuk {
            width: 100%;
            padding: 14px;
            background-color: #0ea5e9;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.1s ease;
            margin-top: 10px;
        }

        .btn-masuk:hover {
            background-color: #0284c7;
        }

        .btn-masuk:active {
            transform: scale(0.98);
        }

        .login-footer {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #64748b;
        }

        .login-footer a {
            color: #0ea5e9;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-footer a:hover {
            color: #0284c7;
            text-decoration: underline;
        }
  
        .halaman-footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            font-size: 13px;
            color: #64748b; 
        }

        .halaman-footer a {
            color: #0ea5e9;
            text-decoration: none;
            margin: 0 5px;
            transition: color 0.3s ease;
        }

        .halaman-footer a:hover {
            color: #0284c7;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <img src="images.png" alt="Logo MBG" class="header-logo">
        
        <div class="header-text">
            <h1>MBG</h1> 
            <p>Silakan masuk ke akun Anda</p>
        </div>
        
        <form action="login-proses.php" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn-masuk">Masuk</button>
        </form>

        <div class="login-footer">
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>
    </div>
    <div class="halaman-footer">
        &copy; 2026 MBG Sim Gizi .<br>
    </div>
</body>
</html>