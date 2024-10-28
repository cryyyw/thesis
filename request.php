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
      height: 350px; /* Adjust the height as needed */
    }

    #map {
      width: 100%;
      height: 89%;
    }
  </style>
</head>

<body>
  <?php include "nav2.php"; ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1><?php
                   
                        $id =  $_GET['id'];
                        $sql = "select * from carwash where id = '$id'";
                          $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo $row['wash_name'];
                                        }
                        ?></h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="col-xxl-12 col-md-12">
        
          <div class="card info-card">
            <div class="card-body p-0">              
              <div id="map">
                


              </div>
<div id="cancelRouteContainer" class="mt-2" style="display:none; ">
      <center><button id="cancelRouteBtn" class="btn btn-danger btn-sm">Cancel Route</button></center>
    </div>
            </div>

         
          </div>

        <section class="section dashboard">
      <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <div class="error-message">
                        <?php
                        if (!empty($_GET['error_message'])) {

                          $co = isset($_GET['color']) ? $_GET['color'] : 'p';
                          if($co == "p"){

                            echo "<div class='alert alert-primary' style='text-align:center;' role='alert'> " . $_GET['error_message'] . "</div>";
                          }
                          else{
                            echo "<div class='alert alert-danger' style='text-align:center;' role='alert'> " . $_GET['error_message'] . "</div>";

                          }
                        }
                        ?>
                    </div>
                </div>
                <div class="card-body">
        <center><h4><b>Services</b></h4></center>
        <hr>
        <div class="container text-center">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
          <div class="col"><h5>Car</h5>
              <div>
                  <div class="container m-0">

                    <?php
                        
                        include "dbcon.php";
                        $id =  $_GET['id'];
                        $sql = "select * from services where carwash = '$id' and for_vehicle = 'Car'";
                          $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo " <div class='row'>
                      <div class='col'>
                       <input type='checkbox' name='services[]' data-price='".$row['price']."' value='".$row['id']."' onchange='calculateTotal()'>
                      </div>
                      <div class='col'>
                        ".$row['price']." - ".$row['services']."
                      </div>
                      
                    </div>";
                                        }
                        ?>
                    
                  </div>
                

            </div>
          </div>
          <div class="col"><h5>Motor</h5>
<div>
                  <div class="container m-0">

                    <?php
                        
                        include "dbcon.php";
                        $id =  $_GET['id'];
                        $sql = "select * from services where carwash = '$id' and for_vehicle = 'Motor'";
                          $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo " <div class='row'>
                      <div class='col'>
                       <input type='checkbox' name='services[]' data-price='".$row['price']."' value='".$row['id']."' onchange='calculateTotal()'>
                      </div>
                      <div class='col'>
                        ".$row['price']." - ".$row['services']."
                      </div>
                      
                    </div>";
                                        }
                        ?>
                    
                  </div>
                

            </div>
          </div>
          <div class="col"><h5>Vehicle</h5>

          </div>
        
        </div>
        </div>


        </div>
        <div class="card-footer">
     <div id="cancelRouteContainer" >




    
      <center><button id="cancelRouteBtn" class="btn btn-sm" style='background-color:#1f9acd;color:white;' data-bs-toggle="modal" data-bs-target="#exampleModal">Request</button></center>
    </div>
  </div>

              </div>

              <div class="container text-center " style="display:none;">
   <h4>Total Price: <span id="totalPrice">0</span></h4>
</div>
            </div><!-- End Recent Sales -->

    </section>
       
      </div>

    </section>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Receipt</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="requestcustomer.php" method="post">
          <input type="hidden" id="selectedServiceIds" name="selectedServiceIds">
          <input type="hidden" name="from" value="<?php echo $_GET['id'];?>">
          <label for="exampleInputEmail1" class="form-label">Selected Services:</label>
          <ul id="selectedServicesList"></ul> 

          <div class="input-group mb-3">
            <span class="input-group-text">Date & Time</span>
            <input type="date" aria-label="Date" class="form-control" name="datee" id="dateInput" required>
            <select class="form-control" name="target_time" id="timeSelect" required>
            </select>
          </div>
          
          <div class="flex-nowrap">
            <label for="exampleInputEmail1" class="form-label">Total</label>
            <input type="text" class="form-control" name="total" placeholder="0.00" id="modalTotalPrice" readonly>
          </div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="btnbtn" disabled>Request</button>
        </form>
      </div>
    </div>
  </div>
</div>
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
document.querySelector('#dateInput').addEventListener('change', function() {
    let selectedDate = this.value;
    fetchAvailableTimes(selectedDate);
});

function fetchAvailableTimes(date) {
    fetch('checkAvailability.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'date=' + encodeURIComponent(date)
    })
    .then(response => response.json())
    .then(bookedTimes => {
        let timeSelect = document.querySelector('#timeSelect');
        timeSelect.innerHTML = ''; // Clear existing options

        const openingTime = 7;
        const closingTime = 17;
        
        const unavailableTimes = bookedTimes.map(time => time.slice(0, 5)); // Format to 'HH:MM'

        for (let hour = openingTime; hour <= closingTime; hour++) {
            const formattedHour = hour < 10 ? '0' + hour : hour;
            const timeOption = `${formattedHour}:00`;

            if (!unavailableTimes.includes(timeOption)) {
                const optionElement = document.createElement('option');
                optionElement.value = timeOption;
                optionElement.text = timeOption;
                timeSelect.appendChild(optionElement);
            }
        }
    })
    .catch(error => console.error('Error fetching available times:', error));
}

document.querySelector('#timeSelect').addEventListener('change', function() {
    const selectedDate = document.querySelector('#dateInput').value;
    const selectedTime = this.value;
    document.querySelector('#btnbtn').disabled = !selectedDate || !selectedTime;
});
</script>

<script>
function calculateTotal() {
  const checkboxes = document.querySelectorAll('input[type="checkbox"][name="services[]"]');
  let total = 0;
  let selectedServices = [];
  let selectedServiceIds = [];

  // Loop through the checkboxes to gather selected ones
  checkboxes.forEach(function(checkbox) {
    if (checkbox.checked) {
      total += parseFloat(checkbox.getAttribute('data-price'));
      selectedServices.push(checkbox.parentElement.nextElementSibling.textContent.trim()); // Service name and price
      selectedServiceIds.push(checkbox.value); // Service ID
    }
  });

  // Update total price in the modal
  document.getElementById('totalPrice').innerText = total.toFixed(2);
  document.getElementById('modalTotalPrice').value = total.toFixed(2);
  var x =  total.toFixed(2);
const btnbtn = document.getElementById('btnbtn');
  if(x<=0){
    btnbtn.disabled = true;

  }else{
btnbtn.disabled = false;
  }


  // Display selected services in the modal
  const selectedServicesList = document.getElementById('selectedServicesList');
  selectedServicesList.innerHTML = "";
  selectedServices.forEach(service => {
    const li = document.createElement('li');
    li.textContent = service;
    selectedServicesList.appendChild(li);
  });

  // Place selected service IDs into the hidden input
  document.getElementById('selectedServiceIds').value = selectedServiceIds.join(',');
}

// Attach event listener for the "Request" button to trigger modal update
document.getElementById('cancelRouteBtn').addEventListener('click', calculateTotal);

</script>
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
      $id = $_GET['id'];
      $sql = "SELECT * FROM carwash where id = '$id'";
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

          <center>
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
