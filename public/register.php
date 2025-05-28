<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi Pengguna</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #74ebd5, #9face6);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .register-container {
      background: #fff;
      padding: 35px 40px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      width: 350px;
      animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #2c3e50;
      font-weight: bold;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #34495e;
    }

    .input-group {
      position: relative;
    }

    .input-group i {
      position: absolute;
      top: 11px;
      left: 12px;
      color: #888;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px 10px 10px 34px;
      margin-bottom: 18px;
      border: 1px solid #ccc;
      border-radius: 8px;
      transition: 0.3s;
      outline: none;
      box-sizing: border-box;
    }

    input:focus {
      border-color: #7f8c8d;
      box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
    }

    button {
      width: 100%;
      padding: 12px;
      background: linear-gradient(135deg, #3498db, #2ecc71);
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background: linear-gradient(135deg, #2980b9, #27ae60);
    }

    .footer {
      text-align: center;
      margin-top: 18px;
      font-size: 14px;
      color: #555;
    }

    .footer a {
      color: #2980b9;
      text-decoration: none;
      font-weight: bold;
    }

    .footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="register-container">
    <h2><i class="fas fa-user-plus"></i> Registrasi</h2>
    <form action="register_process.php" method="POST">
      
      <label for="name">Nama:</label>
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" id="name" name="name" required>
      </div>

      <label for="email">Email:</label>
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" id="email" name="email" required>
      </div>

      <label for="password">Password:</label>
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" id="password" name="password" required>
      </div>

      <button type="submit">Daftar</button>
    </form>

    <div class="footer">
      Sudah punya akun? <a href="login.php">Login di sini</a>
    </div>
  </div>

</body>
</html>
