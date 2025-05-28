<?php
session_start();
$user_name = $_SESSION['user_name'] ?? ($_COOKIE['user_name'] ?? null);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard E-Meeting</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #74ebd5, #ACB6E5);
      color: #333;
    }
    header {
      background: linear-gradient(to right, #0077cc, #6a11cb);
      color: white;
      padding: 1rem 2rem;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    main {
      max-width: 960px;
      margin: 50px auto;
      background: white;
      padding: 2rem;
      border-radius: 16px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      text-align: center;
    }
    h2, h1 {
      margin: 0;
    }
    .menu-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin-top: 2rem;
    }
    .menu-item {
      width: 160px;
      height: 150px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-decoration: none;
      border-radius: 14px;
      color: white;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 6px 12px rgba(0,0,0,0.1);
      position: relative;
    }

    /* Warna acak setiap menu */
    .menu-item:nth-child(1) { background: #ff6b6b; }
    .menu-item:nth-child(2) { background: #6c5ce7; }
    .menu-item:nth-child(3) { background: #00b894; }
    .menu-item:nth-child(4) { background: #e17055; }
    .menu-item:nth-child(5) { background: #0984e3; }
    .menu-item:nth-child(6) { background: #fd79a8; }

    .menu-item:hover {
      transform: scale(1.05);
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .menu-item svg {
      width: 36px;
      height: 36px;
      margin-bottom: 10px;
    }

    .note {
      margin-top: 2rem;
      font-size: 0.95rem;
      color: #666;
    }

    @media (max-width: 600px) {
      .menu-item {
        width: 120px;
        height: 120px;
      }
      .menu-item span {
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>
  <header>
    <h2>Dashboard E-Meeting</h2>
  </header>
  <main>
    <?php if ($user_name): ?>
      <p>Selamat datang, <strong><?= htmlspecialchars($user_name); ?></strong>!</p>
      <div class="menu-grid">
        <a class="menu-item" href="profile.php">
          <i data-lucide="user"></i>
          <span>Profil</span>
        </a>
        <a class="menu-item" href="events.php">
          <i data-lucide="calendar-plus"></i>
          <span>Event</span>
        </a>
        <a class="menu-item" href="list_meetings.php">
          <i data-lucide="video"></i>
          <span>Meeting</span>
        </a>
        <a class="menu-item" href="calender.php">
          <i data-lucide="calendar-days"></i>
          <span>Kalender</span>
        </a>
        <a class="menu-item" href="logout.php">
          <i data-lucide="log-out"></i>
          <span>Logout</span>
        </a>
      </div>
    <?php else: ?>
      <p>Anda belum login.</p>
      <div class="menu-grid">
        <a class="menu-item" href="login.php">
          <i data-lucide="log-in"></i>
          <span>Login</span>
        </a>
        <a class="menu-item" href="register.php">
          <i data-lucide="user-plus"></i>
          <span>Daftar</span>
        </a>
      </div>
    <?php endif; ?>
    <p class="note">Silakan pilih menu untuk mulai menggunakan aplikasi.</p>
  </main>

  <script>
    lucide.createIcons();
  </script>
</body>
</html>
