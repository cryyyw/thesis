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
      <h1 style="color:#3d97b9;">Pending Requests  </h1>

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
      <th scope="col">Customer</th>
      <th scope="col">Services</th>
      <th scope="col">Total</th>
      <th scope="col">Sent Request</th>
      <th scope="col">Target Date</th>
      <th scope="col">Target Time</th>
      <th scope="col">Cancelation Time</th>

      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $id = $_SESSION['id'];
      $sql = "SELECT r.id, r.customer, cu.fullname,
       r.total, 
       r.status, 
       r.sent_request, 
       r.target_date, 
       r.target_time, 
       c.wash_name,
       r.carwash, 
       r.cancelationtime,
       GROUP_CONCAT(s.services ORDER BY s.services SEPARATOR ', ') AS service_names 
       FROM request r 
       JOIN services s ON FIND_IN_SET(s.id, r.service) > 0 
       INNER JOIN carwash c ON c.id = r.carwash 
       INNER JOIN customer cu on cu.id = r.customer
       WHERE r.carwash = '$id' and r.status NOT IN ('Reported', 'Completed', 'Canceled', 'Rejected')
       GROUP BY r.id";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['fullname']) . "</td>";

              // Convert service_names into a list
              $services = explode(', ', $row['service_names']);
              echo "<td><ul>";
              foreach ($services as $service) {
                  echo "<li>" . htmlspecialchars($service) . "</li>";
              }
              echo "</ul></td>";

              echo "<td>$" . htmlspecialchars($row['total']) . "</td>";
              echo "<td>" . htmlspecialchars($row['sent_request']) . "</td>";
              echo "<td>" . htmlspecialchars($row['target_date']) . "</td>";
              echo "<td>" . htmlspecialchars($row['target_time']) . "</td>";
              echo "<td>" . htmlspecialchars($row['cancelationtime']) . "</td>";

              echo "<td>" . htmlspecialchars($row['status']) . "</td>";

              // Action buttons (customize as needed)


             
                if($row['status']=="Cancel"){

                  echo "<td>";

                  echo "<center><button  class='btn btn-sm bg-danger text-white'  data-bs-toggle='modal' data-bs-target='#Modal1".$row['id']."'><i class='bi bi-check-circle'></i> Cancel</button> </center>"; 

                  echo "<div class='modal fade' id='Modal1".$row['id']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                      <div class='modal-content'>
                        <div class='modal-header bg-danger text-white'>
                          <h1 class='modal-title fs-5' id='exampleModalLabel'>Cancel</h1>
                          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                          <form action='carwashcancelrequest.php' method='post'>
                          <input type='hidden' name='id' value='".$row['id']."'>
                          <input type='hidden' name='custo' value='".$row['customer']."'>
                         
                         


                          <center>Are you sure you want to cancel this request?</center>
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                          <button type='submit' class='btn btn-danger'>Cancel</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>";


                  echo "</td>";

                }
                else if($row['status']=="Accepted"){
                  echo "<td>";
                  echo "<button  class='btn btn-sm text-white' style='background-color:#1f9acd;'  data-bs-toggle='modal' data-bs-target='#com".$row['id']."'>Complete</button> ";
                  echo "<div class='modal fade' id='com".$row['id']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' >
                      <div class='modal-content' >
                        <div class='modal-header text-white' style='background-color:#1f9acd;'>
                          <h1 class='modal-title fs-5' id='exampleModalLabel'>Complete A request</h1>
                          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                          <form action='comrequest.php' method='post'>
                          <input type='hidden' name='id' value='".$row['id']."'>
                          <input type='hidden' name='car' value='".$row['carwash']."'>
                         


                          <center>Are you sure you completed this request?</center>
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                          <button type='submit' class='btn text-white' style='background-color:#1f9acd;'>Confirm</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>";
                  echo "</td>";
                }
                else{
                  echo "<td>";
        

                echo "<button  class='btn btn-sm' style='background-color:#1f9acd;'  data-bs-toggle='modal' data-bs-target='#accepted".$row['id']."'><i class='bi bi-check-circle'></i></button> "; 
              echo "<button  class='btn btn-sm' style='background-color:#dffdff;'  data-bs-toggle='modal' data-bs-target='#exampleModal".$row['id']."'><i class='bi bi-x-lg'></i></button> "; 
              echo "<button  class='btn btn-warning btn-sm' style='background-color:#3d97b9;'><i class='bi bi-clock'></i></button>";



              echo "<div class='modal fade' id='exampleModal".$row['id']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                      <div class='modal-content'>
                        <div class='modal-header bg-danger text-white'>
                          <h1 class='modal-title fs-5' id='exampleModalLabel'>Reject</h1>
                          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                          <form action='rejectrequest.php' method='post'>
                          <input type='hidden' name='id' value='".$row['id']."'>
                          <input type='hidden' name='car' value='".$row['carwash']."'>
                         


                          <center>Are you sure you want to Reject this request?</center>
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                          <button type='submit' class='btn btn-danger'>Reject</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>";
                   echo "<div class='modal fade' id='accepted".$row['id']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                      <div class='modal-content'>
                        <div class='modal-header bg-primary text-white'>
                          <h1 class='modal-title fs-5' id='exampleModalLabel'>Accept</h1>
                          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                          <form action='acceptrequest.php' method='post'>
                          <input type='hidden' name='id' value='".$row['id']."'>
                          <input type='hidden' name='car' value='".$row['carwash']."'>
                          <center>Are you sure you want to Accepted this request?</center>
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                          <button type='submit' class='btn btn-primary'>Accept</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>";
              echo "</td>";
                }
                
             
              

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


