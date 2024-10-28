<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaflet Map with PHP Markers</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        #map { height: 90vh; }
    </style>
</head>
<body>
    <div id="map"></div>

    <footer class="footer mt-auto py-3" style="background-color: #3d97b9;">
        <div class="container text-center">
            <button class="btn" style="background-color: #3d97b9;color: white;" onclick="javascript:history.back();">
                <i class="fas fa-arrow-left"></i> <i class="bi bi-arrow-bar-left"></i> Go Back
            </button>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        var map = L.map('map').setView([
            <?php
            include "dbcon.php";
            $id = $_GET['id'];
            $sql  = "SELECT * FROM carwash WHERE id = '$id'";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_array($result)) {
                echo $row['location'];
            }
            ?>
        ], 12);

        // Add a tile layer (this is required to load the map tiles)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Add a marker at the given location
        L.marker([<?php
            include "dbcon.php";
            $id = $_GET['id'];
            $sql  = "SELECT * FROM carwash WHERE id = '$id'";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_array($result)) {
                echo $row['location'];
            }
            ?>])
            .addTo(map)
            .bindPopup("Carwash location: " + "<?php echo $row['location']; ?>"); // Add a popup with the location
    </script>
</body>
</html>
