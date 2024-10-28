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

    <footer class="footer mt-auto py-3 " style="background-color: #3d97b9;">
        <div class="container text-center">
            <button class="btn btm" style="background-color: #3d97b9;color: white;" onclick="javascript:history.back();">
                <i class="fas fa-arrow-left"></i> Go Back
            </button>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />
    <script src="https://unpkg.com/leaflet.locatecontrol/dist/L.Control.Locate.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Initialize the map
        const map = L.map('map').setView([14.072585268549238, 120.63206538116192], 13);

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Add locate control
        L.control.locate().addTo(map);

        // Define custom icon
       

        // Simulate fetching markers from the backend
        const markers = [
            <?php
            include "dbcon.php";
            $sql = "SELECT * FROM carwash";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                list($latitude, $longitude) = explode(',', $row['location']); // Assuming 'location' has 'lat,long' format
                
                // Output each marker as a JavaScript object
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

        // Place markers on the map
        markers.forEach(marker => {


             const customIcon = L.icon({
                iconUrl: `upload/${marker.image}`, // Path to the image in the upload folder
                iconSize: [40, 40], // Size of the icon
                iconAnchor: [15, 40], // Point of the icon which will correspond to marker's location
                popupAnchor: [0, -40] // Point from which the popup should open relative to the iconAnchor
            });


            // Create a marker for each data entry with the custom icon
            const leafletMarker = L.marker([marker.lat, marker.lng], { icon: customIcon }).addTo(map);

            // Create popup content with image and button
            const popupContent = `
                <div>
                    <center><img src="upload/${marker.image}" alt="Image" style="width: 175px; height: 175px;"></center>
                    <h4>${marker.title}</h4>
                    <h6>Location: ${marker.lat}</h6>
                    <h6>Owner: ${marker.user}</h6>

                    <center><a href="carwash.php?id=${marker.id}" class="btn btn-primary btn-sm mt-2 text-white">View Details</a></center>
                </div>`;
            leafletMarker.bindPopup(popupContent);
        });
    });
</script>

</body>
</html>
