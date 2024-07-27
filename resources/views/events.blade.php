<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventDev - Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="../../public/assets/img/logo_barra.png">
    <link rel="stylesheet" href="../../resources/api_sources/read.css">
    <link rel="stylesheet" href="../css/events_page.css">
</head>

<body>
    <div class="content">
        <?php
            include "../../api/src/events/read_events.php";
        ?>
    </div>
    <footer class="text-dark justify-content-between align-items-center py-3">
        <div class="container">
            <div class="row">
                <div class="col text-start">
                    <p class="mb-0">&copy; 2024 EventDev. All rights reserved.</p>
                </div>
                <div class="col text-end">
                    <p class="mb-0">Made for <a href="https://beacons.ai/davi.j" target="_blank">Davi José</a></p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/f0c76a2bf3.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
</body>

</html>