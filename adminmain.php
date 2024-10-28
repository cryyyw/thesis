<?php 
 session_start();
   include "dbcon.php";
  if (!isset($_SESSION['role']) ||(trim ($_SESSION['role']) == '')) {
        header('location:index.php');
        exit();
    }  ?>

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
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    .info-card{
      color: #3d97b9;
    }
  </style>
</head>
 
<body>
  <?php
    include "nav1.php";
  ?>
  
  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
       
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="container">
  <div class="row">
     <div class="col-xxl-3 col-md-6">
      <a href="landlordlist.php">
      <div class="card info-card ">
         <div class="card-body">
                  <h5 class="card-title">No. Of Car Wash</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon  d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>1</h6>

                    </div>
                  </div>
                </div>
      </div>
    </a>
    </div>
    <!-- Sales Card -->
    <div class="col-xxl-3 col-md-6">
      <a href="tenantlist.php">
      <div class="card info-card ">
       <div class="card-body">
                  <h5 class="card-title">No. Of User </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>1</h6>

                    </div>
                  </div>
                </div>
      </div>
    </a>
    </div>

    <!-- Revenue Card -->
    <div class="col-xxl-3 col-md-6">
      <a href="tenantlist.php">
      <div class="card info-card ">

         <div class="card-body">
                  <h5 class="card-title">No. of Blocked Account </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-houses"></i>
                    </div>
                    <div class="ps-3">
                      <h6>1</h6>

                    </div>
                  </div>
                </div>
      </div>
    </a>
    </div>

    <!-- Customers Card 1 -->
    <div class="col-xxl-3 col-md-6">
        <a href="complainss.php">
      <div class="card info-card ">
         <div class="card-body">
                  <h5 class="card-title">Pending</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-card-list"></i>
                    </div>
                    <div class="ps-3">
                      <h6>1</h6>
                    

                    </div>
                  </div>
                </div>
      </div>
        </a>
    </div>

    <!-- Customers Card 2 -->
   
  </div>
</div>

    </section>

      <section class="section dashboard">
      <div class="container">
        <div class="row">
          <div class="col-xxl-6 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <!-- <canvas id="myChart" style="width:100%;max-width:600px"></canvas> -->
                <canvas class="mt-3" id="aestheticChart" style="width:100%;max-width:600px"></canvas>
              </div>
            </div>
          </div>

          <div class="col-xxl-6 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <!-- <canvas class="mt-3" id="myChart1" style="width:100%;max-width:600px"></canvas> -->
                <canvas class="mt-3" id="aestheticBarChart" style="width:100%;max-width:600px"></canvas>
              </div>
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

</body>

</html>

<script>
  // Get the canvas element for the line chart
  const ctxLineChart = document.getElementById('aestheticChart').getContext('2d');

  // Create a gradient for the line
  const gradientLine = ctxLineChart.createLinearGradient(0, 0, 0, 400);
  gradientLine.addColorStop(0, '#3d97b9');
  gradientLine.addColorStop(1, '#dffdff');

  // Define the line chart
  const myLineChart = new Chart(ctxLineChart, {
    type: 'line',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [{
        label: 'Customer Demand',
        data: [30, 50, 40, 60, 80, 75, 95],
        backgroundColor: gradientLine, // Fill gradient
        borderColor: '#3d97b9', // Line color
        borderWidth: 2,
        pointBackgroundColor: '#ffffff', // White points
        pointBorderColor: '#3d97b9',
        pointHoverRadius: 7, // Bigger point on hover
        tension: 0.4, // Curved line
        fill: true // Fill the area under the line
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true,
          labels: {
            color: '#333' // Text color for labels
          }
        },
        tooltip: {
          backgroundColor: '#3d97b9',
          titleColor: '#fff',
          bodyColor: '#fff',
          bodyFont: {
            size: 14
          },
          padding: 10,
          cornerRadius: 5
        }
      },
      scales: {
        x: {
          grid: {
            display: false // Hide x-axis grid lines
          },
          ticks: {
            color: '#333' // Label color
          }
        },
        y: {
          grid: {
            borderDash: [5, 5], // Dashed grid lines
            color: 'rgba(200, 200, 200, 0.3)' // Light gray grid color
          },
          ticks: {
            color: '#333' // Label color
          }
        }
      }
    }
  });
</script>

<script>
  // Get the canvas element for the bar chart
  const ctxBarChart = document.getElementById('aestheticBarChart').getContext('2d');

  // Create a gradient for the bars
  const gradientBar = ctxBarChart.createLinearGradient(0, 0, 0, 400);

  gradientBar.addColorStop(0, '#3d97b9');
  gradientBar.addColorStop(1, '#dffdff');

  // Define the bar chart
  const myBarChart = new Chart(ctxBarChart, {
    type: 'bar',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [{
        label: 'Revenue',
        data: [40, 60, 50, 80, 90, 75, 100],
        backgroundColor: gradientBar, // Gradient color for bars
        borderColor: '#3d97b9', // Border color for bars
        borderWidth: 1,
        borderRadius: 10, // Rounded corners for bars
        barPercentage: 0.7, // Width of bars
        hoverBackgroundColor: '#3d97b9', // Darker color on hover
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true,
          labels: {
            color: '#333' // Legend text color
          }
        },
        tooltip: {
          backgroundColor: 'rgba(0,0,0,0.7)', // Dark tooltip background
          titleColor: '#fff', // Tooltip title text color
          bodyColor: '#fff', // Tooltip body text color
          bodyFont: {
            size: 14 // Text size inside the tooltip
          },
          padding: 10,
          cornerRadius: 5
        }
      },
      scales: {
        x: {
          grid: {
            display: false // Hide grid lines on the x-axis
          },
          ticks: {
            color: '#333' // x-axis label color
          }
        },
        y: {
          grid: {
            borderDash: [5, 5], // Dashed grid lines
            color: 'rgba(200, 200, 200, 0.3)' // Light gray grid lines
          },
          ticks: {
            color: '#333' // y-axis label color
          }
        }
      }
    }
  });
</script>
