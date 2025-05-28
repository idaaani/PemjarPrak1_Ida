<?php
require '../config/db.php';
$result = $conn->query("SELECT * FROM meetings ORDER BY date_time ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>📅 Daftar Jadwal Meeting</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #fceabb, #f8b500);
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 8px 5px;
            text-decoration: none;
            color: white;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-success:hover {
            background-color: #1e7e34;
        }

        .btn-edit {
            color: #17a2b8;
            font-weight: bold;
        }

        .btn-edit:hover {
            text-decoration: underline;
        }

        .btn-delete {
            color: #dc3545;
            font-weight: bold;
        }

        .btn-delete:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 14px 18px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f9ff;
        }

        .actions a {
            margin-right: 10px;
        }

        .no-data {
            text-align: center;
            color: #666;
            font-style: italic;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin: 10px 0;
                background: #f9f9f9;
                padding: 10px;
                border-radius: 10px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            }

            td {
                padding: 10px;
                border: none;
                position: relative;
                padding-left: 50%;
            }

            td::before {
                position: absolute;
                top: 10px;
                left: 10px;
                width: 45%;
                white-space: nowrap;
                font-weight: bold;
                color: #555;
            }

            td:nth-of-type(1)::before { content: "Judul"; }
            td:nth-of-type(2)::before { content: "Waktu"; }
            td:nth-of-type(3)::before { content: "Lokasi"; }
            td:nth-of-type(4)::before { content: "Aksi"; }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📅 Daftar Jadwal Meeting</h2>

    <div style="text-align:center;">
        <a href="add_meeting.php" class="btn btn-primary"><span class="material-icons" style="vertical-align: middle;">add</span> Tambah Meeting</a>
        <a href="dasboard.php" class="btn btn-success"><span class="material-icons" style="vertical-align: middle;">arrow_back</span> Dashboard</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Waktu</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars(date('d M Y, H:i', strtotime($row['date_time']))) ?></td>
                    <td><?= htmlspecialchars($row['location']) ?></td>
                    <td class="actions">
                        <a href="edit_meeting.php?id=<?= urlencode($row['id']) ?>" class="btn-edit">Edit</a>
                        <a href="delete_meeting.php?id=<?= urlencode($row['id']) ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus meeting ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="no-data">Tidak ada jadwal meeting.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php $conn->close(); ?>
