<?php
require '../config/google-config.php';
$auth_url = $client->createAuthUrl();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Pengguna</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #333;
    }

    .login-container {
      background: #fff;
      padding: 35px 40px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      width: 350px;
      transition: all 0.3s ease;
    }

    .login-container:hover {
      transform: translateY(-2px);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 25px;
    }

    label {
      font-weight: 600;
      margin-top: 15px;
      display: block;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      margin-top: 5px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      transition: 0.3s ease;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #2575fc;
      outline: none;
      box-shadow: 0 0 5px rgba(37, 117, 252, 0.4);
    }

    .checkbox-container {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }

    .checkbox-container input {
      margin-right: 8px;
    }

    button {
      width: 100%;
      padding: 10px;
      background: #2575fc;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 15px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background: #1b5fd2;
    }

    .google-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      background-color: #db4437;
      color: white;
      padding: 10px;
      margin-top: 12px;
      border: none;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .google-btn i {
      margin-right: 8px;
    }

    .google-btn:hover {
      background-color: #c13a2e;
    }

    .footer {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
    }

    .footer a {
      color: #2575fc;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>🔐 Login E-Meeting</h2>
    <form action="login_process.php" method="POST">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" required>

      <label for="password">Password</label>
      <input type="password" name="password" id="password" required>

      <div class="checkbox-container">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Ingat Saya</label>
      </div>

      <button type="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
    </form>

    <a class="google-btn" href="<?= $auth_url ?>">
      <i class="fab fa-google"></i> Login dengan Google
    </a>

    <div class="footer">
      Belum punya akun? <a href="register.php">Daftar di sini</a>
    </div>
  </div>
</body>
</html>
