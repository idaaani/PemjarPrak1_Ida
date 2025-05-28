<?php
session_start();

$user_name = $_SESSION['user_name'] ?? $_COOKIE['user_name'] ?? null;

if (!$user_name) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Pengguna</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    :root {
      --blue: #4e54c8;
      --purple: #8f94fb;
      --danger: #e74c3c;
      --info: #3498db;
    }
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Rubik', sans-serif;
      background: linear-gradient(135deg, var(--blue), var(--purple));
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      color: #333;
    }
    .container {
      background: white;
      padding: 2rem;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      max-width: 500px;
      width: 90%;
      text-align: center;
      animation: fadeIn 0.8s ease;
    }
    header h2 {
      background: linear-gradient(to right, var(--blue), var(--purple));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-size: 1.8rem;
      margin-bottom: 1.5rem;
    }
    .profile-info p {
      font-size: 1.2rem;
      margin: 1rem 0;
    }
    .buttons {
      margin-top: 2rem;
      display: flex;
      justify-content: center;
      gap: 1rem;
      flex-wrap: wrap;
    }
    .btn {
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      color: white;
      text-decoration: none;
      font-weight: bold;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.3s ease;
    }
    .btn svg {
      width: 20px;
      height: 20px;
    }
    .btn-logout {
      background: var(--danger);
    }
    .btn-logout:hover {
      background: #c0392b;
    }
    .btn-dashboard {
      background: var(--info);
    }
    .btn-dashboard:hover {
      background: #2c80b4;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 500px) {
      .profile-info p {
        font-size: 1rem;
      }
      .btn {
        font-size: 0.9rem;
        padding: 0.6rem 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h2>Profil Pengguna</h2>
    </header>
    <div class="profile-info">
      <p><strong>Nama:</strong> <?= htmlspecialchars($user_name); ?></p>
    </div>
    <div class="buttons">
      <a class="btn btn-logout" href="logout.php">
        <i data-lucide="log-out"></i> Logout
      </a>
      <a class="btn btn-dashboard" href="dasboard.php">
        <i data-lucide="layout-dashboard"></i> Dashboard
      </a>
    </div>
  </div>
  <script>
    lucide.createIcons();
  </script>
</body>
</html>
