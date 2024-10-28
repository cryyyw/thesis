<?php 
 session_start();
   include "dbcon.php";
  if (!isset($_SESSION['role']) ||(trim ($_SESSION['role']) == '')) {
        header('location:main.php');
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
  <link href="logo.png" rel="icon">
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
  <style type="text/css">
    .error-message {
            height: 10px; /* Fixed height for the error message container */
            margin-bottom: 10px;
            margin-top: 10px;

        }
  </style>
</head>

<body>
  <?php
    include "nav3.php";
  ?>
  
  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1 style="color:#3d97b9;">Reports   <div class="float-end"><button class="btn btn-primary btn-sm" data-bs-toggle='modal' data-bs-target='#generate'>Create report</button></div></h1>

      <nav>
       
      </nav>
    </div><!-- End Page Title -->

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
                <div class="card-body mt-3">

                  <!-- <h5 class="card-title">Landlord List</h5> -->
                  

                  <table class="table table-borderless datatable mt-2" id="data-table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Services</th>
    
      <th scope="col">Start Date</th>
      <th scope="col">End Date</th>
      <th scope="col">Create Date</th>
      <th scope="col">Action</th>
    


    </tr>
  </thead>
  <tbody>
    <?php
    $id = $_SESSION['id'];
      $sql = "SELECT 

      * 


      FROM `car_reports` WHERE car = '$id'";
      $result = mysqli_query($conn, $sql);
      $n=1;
      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>".$n."</td>";
              $n++;
           
              echo "<td>" . htmlspecialchars($row['service']) . "</td>";
              echo "<td>" . htmlspecialchars($row['startdate']) . "</td>";
              echo "<td>" . htmlspecialchars($row['enddate']) . "</td>";
              echo "<td>" . htmlspecialchars($row['createdate']) . "</td>";
              echo "<td><a href='reportcar.php?id=".$row['id']."' class='btn btn-sm btn-primary'><i class='bi bi-printer'></i></a>
              <button class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#Modal1".$row['id']."'><i class='bi bi-x-circle'></i></button>";


             

                  echo "<div class='modal fade' id='Modal1".$row['id']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                      <div class='modal-content'>
                        <div class='modal-header bg-danger text-white'>
                          <h1 class='modal-title fs-5' id='exampleModalLabel'>Delete Report</h1>
                          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                          <form action='removereport.php' method='post'>
                          <input type='hidden' name='id' value='".$row['id']."'>
                        
                         
                         


                          <center>Are you sure you want to cancel this report?</center>
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                          <button type='submit' class='btn btn-danger'>Remove</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div></td>";



              

    

              
                
             
              

              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='8'>No records found.</td></tr>";
      }
    ?>
  </tbody>
</table>


                </div>

              </div>
            </div><!-- End Recent Sales -->

    </section>

  </main>



<div class="modal fade" id="generate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Report</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="createreport.php" method="post">
          <center>Services <i class="bi bi-check2-square" onclick="selectAllServices()"></i></center>

          <!-- Select All Button -->
          <!-- <button type="button" class="btn btn-primary my-2" >Select All</button> -->

          <hr>
          <div class="container text-center mt-3">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
              <div class="col"><h5>Car</h5>
                <div class="container m-0">
                  <?php
                      include "dbcon.php";
                      $id =  $_SESSION['id'];
                      $sql = "SELECT * FROM services WHERE carwash = '$id' AND for_vehicle = 'Car'";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_array($result)) {
                          echo "<div class='row'>
                                  <div class='col'>
                                    <input type='checkbox' name='services[]' data-price='".$row['price']."' value='".$row['id']."' onchange='calculateTotal()'>
                                  </div>
                                  <div class='col'>
                                    ".$row['services']."
                                  </div>
                                </div>";
                      }
                  ?>
                </div>
              </div>

              <div class="col"><h5>Motor</h5>
                <div class="container m-0">
                  <?php
                      $sql = "SELECT * FROM services WHERE carwash = '$id' AND for_vehicle = 'Motor'";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_array($result)) {
                          echo "<div class='row'>
                                  <div class='col'>
                                    <input type='checkbox' name='services[]' data-price='".$row['price']."' value='".$row['id']."' onchange='calculateTotal()'>
                                  </div>
                                  <div class='col'>
                                    ".$row['services']."
                                  </div>
                                </div>";
                      }
                  ?>
                </div>
              </div>
              <div class="col"><h5>Vehicle</h5></div>
            </div>
          </div>

          <br><hr><br>
          
          <div class="container text-center">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
              <div class="col">
                <div class="mb-3">
                  <label for="startDate" class="form-label">Start Date</label>
                  <input type="date" class="form-control" id="startDate" name="startdate" required>
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="endDate" class="form-label">End Date</label>
                  <input type="date" class="form-control" id="endDate" name="enddate" required>
                </div>
              </div>
            </div>
          </div>

          <input type="hidden" id="selectedServiceIds" name="selectedServiceIds" readonly>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>
  
  

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
function calculateTotal() {
  const checkboxes = document.querySelectorAll('input[type="checkbox"][name="services[]"]');
  let selectedServiceIds = [];

  // Loop through the checkboxes to gather selected ones
  checkboxes.forEach(function(checkbox) {
    if (checkbox.checked) {
      selectedServiceIds.push(checkbox.value); // Service ID
    }
  });

  // Place selected service IDs into the hidden input
  document.getElementById('selectedServiceIds').value = selectedServiceIds.join(',');
}

// Function to select all checkboxes
function selectAllServices() {
  const checkboxes = document.querySelectorAll('input[type="checkbox"][name="services[]"]');
  checkboxes.forEach(function(checkbox) {
    checkbox.checked = true;
  });
  calculateTotal(); // Update the hidden input with all selected IDs
}
</script>

