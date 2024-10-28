<?php 
 session_start();
   include "dbcon.php";
  if (!isset($_SESSION['role']) ||(trim ($_SESSION['role']) == '')) {
        header('location:index.php');
        exit();
    }  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CleanConnect</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="logooo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Leaflet CSS and JS Files -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

  <!-- Leaflet Locate Control CSS and JS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />
  <script src="https://unpkg.com/leaflet.locatecontrol/dist/L.Control.Locate.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

  <style>
    .info-card {
      color: #3d97b9;
      height: 590px; /* Adjust the height as needed */
    }

    #map {
      width: 100%;
      height: 100%;
    }
  </style>
</head>

<body>
  <?php include "nav2.php"; ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="col-xxl-12 col-md-12">
        
          <div class="card info-card">
            <div class="card-body p-0">
              <div id="map">
                


              </div>

            </div>
            <div class="card-footer">
     <div id="cancelRouteContainer" style="display:none; ">
      <center><button id="cancelRouteBtn" class="btn btn-danger btn-sm">Cancel Route</button></center>
    </div>
  </div>
          </div>
       
      </div>

    </section>

  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
    var map = L.map('map').setView([14.072600965213507, 120.63209994042307], 13); // Example coordinates for Manila, Philippines

    // Add a tile layer to the map
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Add the locate control to the map
    L.control.locate({
        position: 'topleft',
        strings: {
            title: "Show me where I am!"
        },
        flyTo: true
    }).addTo(map);

    let routeControl = null; // Global variable to store route control instance

    const markers = [
      <?php
      include "dbcon.php";
      $sql = "SELECT * FROM carwash";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_array($result)) {
        list($latitude, $longitude) = explode(',', $row['location']); // Assuming 'location' has 'lat,long' format
        echo "{
          id: '{$row['id']}',
          title: '{$row['wash_name']}',
          lat: $latitude,
          lng: $longitude,
          user: '{$row['owner']}',
          image: '{$row['image']}'
        },";
      }
      ?>
    ];

    markers.forEach(marker => {
      const customIcon = L.icon({
        iconUrl: `upload/${marker.image}`, // Path to the image in the upload folder
        iconSize: [40, 40],
        iconAnchor: [15, 40],
        popupAnchor: [0, -40]
      });

      const leafletMarker = L.marker([marker.lat, marker.lng], { icon: customIcon }).addTo(map);

      // Create popup content with image and button
      const popupContent = `
        <div>
          <center><img src="upload/${marker.image}" alt="Image" style="width: 100px; height: 100px;"></center>
          ${marker.title}<br>
          Location: ${marker.lat}<br>
          Owner: ${marker.user}

          <center><a href="request.php?id=${marker.id}" class="btn btn-primary btn-sm  text-white">Request</a>
          <button class='btn btn-success btn-sm create-route-btn' data-lat="${marker.lat}" data-lng="${marker.lng}">Create Route</button>
          </center>
        </div>`;
      
      leafletMarker.bindPopup(popupContent);
    });

    // Event listener for 'Create Route' button clicks
    document.addEventListener('click', function (e) {
      if (e.target && e.target.classList.contains('create-route-btn')) {
        const targetLat = e.target.getAttribute('data-lat');
        const targetLng = e.target.getAttribute('data-lng');

        // Clear existing route if any
        if (routeControl) {
          map.removeControl(routeControl);
        }

        // Create a new route from user's location to the selected marker
        routeControl = L.Routing.control({
          waypoints: [
            null, // Start point (will be user's current location)
            L.latLng(targetLat, targetLng) // End point
          ],
          routeWhileDragging: true
        }).addTo(map);

        // Show the "Cancel Route" button
        document.getElementById('cancelRouteContainer').style.display = 'block';

        // Get user's current location and update the route's starting point
        map.locate({
          setView: true,
          maxZoom: 16
        }).on('locationfound', function (e) {
          routeControl.setWaypoints([e.latlng, L.latLng(targetLat, targetLng)]);
        });
      }
    });

    // Cancel Route button click event
    document.getElementById('cancelRouteBtn').addEventListener('click', function () {
      if (routeControl) {
        map.removeControl(routeControl); // Remove the route from the map
        routeControl = null; // Reset the control
        document.getElementById('cancelRouteContainer').style.display = 'none'; // Hide the cancel button
      }
    });
  </script>
</body>

</html>
