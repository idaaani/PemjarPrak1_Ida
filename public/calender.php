<?php
require '../config/db.php';

// Ambil data meeting dari database
$result = $conn->query("SELECT * FROM meetings ORDER BY date_time ASC");
$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = [
        'title' => $row['title'],
        'start' => date('c', strtotime($row['date_time'])),
        'location' => $row['location']
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Jadwal Meeting</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.5/main.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.5/main.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-weight: 600;
        }

        #calendar {
            max-width: 100%;
        }

        .btn-kembali {
            display: inline-block;
            margin-bottom: 25px;
            padding: 12px 25px;
            background: #0077cc;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .btn-kembali:hover {
            background: #005fa3;
        }

        /* Modal Pop-up */
        .modal {
            display: none;
            position: fixed;
            z-index: 99;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 30px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 12px;
            position: relative;
            animation: fadeIn 0.3s ease;
        }

        .close {
            color: #aaa;
            position: absolute;
            top: 12px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
        }

        .close:hover {
            color: #333;
        }

        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }
    </style>
</head>
<body>

<div class="container">
    <a href="dasboard.php" class="btn-kembali"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
    <h2><i class="fas fa-calendar-alt"></i> Kalender Jadwal Meeting</h2>
    <div id="calendar"></div>
</div>

<!-- Modal Detail Event -->
<div id="eventModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3 id="modalTitle"></h3>
        <p><strong>Lokasi:</strong> <span id="modalLocation"></span></p>
        <p><strong>Waktu:</strong> <span id="modalTime"></span></p>
    </div>
</div>

<script>
    const events = <?php echo json_encode($events); ?>;

    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'standard',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: events,
            eventClick: function (info) {
                const modal = document.getElementById("eventModal");
                const title = info.event.title;
                const location = info.event.extendedProps.location;
                const time = new Date(info.event.start).toLocaleString('id-ID', { timeZone: 'Asia/Jakarta' });

                document.getElementById("modalTitle").textContent = title;
                document.getElementById("modalLocation").textContent = location || '-';
                document.getElementById("modalTime").textContent = time;

                modal.style.display = "block";
            }
        });
        calendar.render();

        // Modal handler
        const modal = document.getElementById("eventModal");
        const closeBtn = document.getElementsByClassName("close")[0];
        closeBtn.onclick = () => modal.style.display = "none";
        window.onclick = (event) => {
            if (event.target === modal) modal.style.display = "none";
        };
    });
</script>

</body>
</html>

<?php $conn->close(); ?>
