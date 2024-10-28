<?php
session_start();
include "dbcon.php"; // Database connection

// Assuming the user has a session ID and the report ID to filter
$id = $_SESSION['id'];
$report_id = $_GET['id']; // Example report ID to filter

// SQL query to filter transactions based on services in car_reports
$sql = "SELECT c.id,
c.service,
c.startdate,
c.enddate,
c.createdate,
ch.wash_name,
ch.image
FROM `car_reports` as c 
INNER JOIN carwash as ch ON c.car = ch.id
WHERE c.id = '$report_id'";
$result = mysqli_query($conn, $sql);

// Initialize variables
$carwash = '';
$startdate = '';
$enddate = '';
$image = '';
$serv = '';

// Fetching the carwash report details
if ($row = mysqli_fetch_assoc($result)) {
    $carwash = $row['wash_name'];
    $startdate = $row['startdate'];
    $enddate = $row['enddate'];
    $image = $row['image'];
    $serv = $row['service'];
}

// Reset the result pointer
mysqli_data_seek($result, 0);

// SQL for counting services
$sql2 = "
WITH RECURSIVE numbers AS (
    SELECT 1 AS n
    UNION ALL
    SELECT n + 1
    FROM numbers
    WHERE n <= 100  -- Adjust this limit based on your maximum expected number of services
),
services_split AS (
    SELECT TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(r.service, ',', numbers.n), ',', -1)) AS service_id
    FROM numbers
    INNER JOIN request r ON CHAR_LENGTH(r.service) - CHAR_LENGTH(REPLACE(r.service, ',', '')) >= numbers.n - 1
    WHERE r.target_date BETWEEN '$startdate' 
    AND '$enddate'  -- Filter for date range
    AND r.status = 'Completed' 
    AND r.carwash = '$id'
    AND TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(r.service, ',', numbers.n), ',', -1)) IN ($serv)

)
SELECT s.services, COUNT(*) AS count
FROM services_split
JOIN services s ON services_split.service_id = s.id
GROUP BY s.services order by s.services;
";

// Fetching the service counts
$result2 = mysqli_query($conn, $sql2);

// Initialize arrays to hold service names and counts
$service = [];
$count = [];

// Populate the service and count arrays
while ($row = mysqli_fetch_assoc($result2)) {
    $service[] = $row['services'];
    $count[] = $row['count'];
}


$sql3 = "SELECT sum(total) as total 
FROM request 
where target_date BETWEEN '$startdate' 
AND '$enddate' 
AND status='Completed' 
AND carwash = '$id';";
$result3 = mysqli_query($conn, $sql3);
while ($row = mysqli_fetch_assoc($result3)) {
    $total = $row['total'];

}

$sql4 = "SELECT avg(rate) AS total_rate
FROM carrate
WHERE car = '$id' 
AND datee BETWEEN '$startdate' AND '$enddate'";
$result4 = mysqli_query($conn, $sql4);
while ($row = mysqli_fetch_assoc($result4)) {
    $total_rate = $row['total_rate'];


    $message = "";
if ($total_rate >= 4.5) {
    $message = "This period saw an exceptional level of customer satisfaction, with clients frequently expressing their appreciation for the outstanding quality of service.";
} elseif ($total_rate >= 3) {
    $message = "Customer satisfaction was notably positive, with many clients expressing their gratitude for the good service provided.";
} else {
    $message = "While there were some positive feedbacks, there is room for improvement as some clients had mixed feelings about the service.";
}	
}

$sql5 = "SELECT status_list.status, 
       COALESCE(COUNT(request.id), 0) AS count
FROM 
    (SELECT 'Completed' AS status
     UNION ALL
     SELECT 'Pending'
     UNION ALL
     SELECT 'Cancelled'
     UNION ALL
     SELECT 'Rejected'
    
    ) AS status_list
LEFT JOIN request ON request.status = status_list.status
GROUP BY status_list.status;";
$result5 = mysqli_query($conn, $sql5);

$status = [];
$statuscount = [];
while ($row = mysqli_fetch_assoc($result5)) {
	$status[] = $row['status'];
	$statuscount[] = $row['count'];	
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carwash Report <?php echo $startdate; ?> - <?php echo $enddate; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @media print {
            .no-print {
                display: none; /* Hide elements with this class when printing */
            }
        }
    </style>
</head>
<body>
    <center>
        <button class="btn btn-primary no-print" onclick="window.print()"> Print </button>
        <button class="btn btn-secondary no-print" onclick="window.history.back()"> Back </button>
    </center>

    <div class="card">
        <div class="card-body" style="background-color: #3d97b9;color: white;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5>Carwash : <?php echo $carwash; ?></h5>
                    <h6>Start Date : <?php echo $startdate; ?></h6>
                    <h6>End Date : <?php echo $enddate; ?></h6>
                </div>
                <div>
                    <img src="upload/<?php echo $image; ?>" width='120px' class="img-fluid" alt="Carwash Image">
                </div>
            </div>
        </div>
    </div>
   

    <center><table class="table table-bordered mt-4 w-75">
        <thead>
            <tr>
                <th>Services</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch and display the service counts
            for ($i = 0; $i < count($service); $i++) {
                echo "<tr>
                    <td>{$service[$i]}</td>
                    <td>{$count[$i]}</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
Total Revenue : ₱<?php echo number_format($total, 2); ?> </center><br>
     <center><p align="justify" class="mt-3">
        From <b><?php echo $startdate; ?></b>, to <b><?php echo $enddate; ?></b>, the carwash <b><?php echo $carwash; ?></b> generated a total revenue of <b>₱<?php echo number_format($total, 2); ?></b> from services provided. <b>Rate(<?php echo $total_rate; ?>)</b> <?php echo $message; ?>
    </p></center>


    <div class="container text-center mt-3">
  <div class="row">
    <div class="col-md-6 col-12">
       <canvas class="mt-3" id="aestheticChart" style="width:100%; max-width:450px; height:300px;"></canvas>
    </div>
    <div class="col-md-6 col-12">
      <canvas class="mt-3" id="aestheticBarChart" style="width:100%; max-width:450px; height:300px;"></canvas>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
</body>
</html>
<script>
  // Get the canvas element for the line chart
  const ctxLineChart = document.getElementById('aestheticChart').getContext('2d');

  // Create a gradient for the line
  const gradientLine = ctxLineChart.createLinearGradient(0, 0, 0, 400);
  gradientLine.addColorStop(0, '#3d97b9');
  gradientLine.addColorStop(1, '#dffdff');
  const statusLabels1 = <?php echo json_encode($service); ?>;
const statusCounts1 = <?php echo json_encode($count); ?>;

  // Define the line chart
  const myLineChart = new Chart(ctxLineChart, {
    type: 'line',
    data: {
      labels: statusLabels1, // Use the status names
        datasets: [{
            label: 'Service Demand',
            data: statusCounts1, // Use the counts
        backgroundColor: gradientLine,
        borderColor: '#3d97b9',
        borderWidth: 2,
        pointBackgroundColor: '#ffffff',
        pointBorderColor: '#3d97b9',
        pointHoverRadius: 7,
        tension: 0.4,
        fill: true
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: true, labels: { color: '#333' } },
        tooltip: {
          backgroundColor: '#3d97b9',
          titleColor: '#fff',
          bodyColor: '#fff',
          bodyFont: { size: 14 },
          padding: 10,
          cornerRadius: 5
        }
      },
      scales: {
        x: { grid: { display: false }, ticks: { color: '#333' } },
        y: { grid: { borderDash: [5, 5], color: 'rgba(200, 200, 200, 0.3)' }, ticks: { color: '#333' } }
      }
    }
  });

  // Get the canvas element for the bar chart
  const ctxBarChart = document.getElementById('aestheticBarChart').getContext('2d');
  const gradientBar = ctxBarChart.createLinearGradient(0, 0, 0, 400);
  gradientBar.addColorStop(0, '#3d97b9');
  gradientBar.addColorStop(1, '#dffdff');
const statusLabels = <?php echo json_encode($status); ?>;
const statusCounts = <?php echo json_encode($statuscount); ?>;
  // Define the bar chart
  const myBarChart = new Chart(ctxBarChart, {
    type: 'bar',
    data: {
      labels: statusLabels, // Use the status names
        datasets: [{
            label: 'Count Per Status',
            data: statusCounts, // Use the counts
        backgroundColor: gradientBar,
        borderColor: '#3d97b9',
        borderWidth: 1,
        borderRadius: 10,
        barPercentage: 0.7,
        hoverBackgroundColor: '#3d97b9',
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: true, labels: { color: '#333' } },
        tooltip: {
          backgroundColor: 'rgba(0,0,0,0.7)',
          titleColor: '#fff',
          bodyColor: '#fff',
          bodyFont: { size: 14 },
          padding: 10,
          cornerRadius: 5
        }
      },
      scales: {
        x: { grid: { display: false }, ticks: { color: '#333' } },
        y: { grid: { borderDash: [5, 5], color: 'rgba(200, 200, 200, 0.3)' }, ticks: { color: '#333' } }
      }
    }
  });
</script>