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
    include "nav1.php";
  ?>
  
  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1 style="color:#3d97b9;">Car Wash List <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="To suspend a carwash, click the 'Suspend' button. The 'Remove' button will only become available if the carwash has been suspended for at least 30 days."></i> <div class="float-end"><button class="btn btn-sm" style="background-color:#1f9acd;color: white;" data-bs-toggle="modal" data-bs-target="#exampleModal">Pending Request <?php
                      $sql = "select count(id) as total from carwash where status='Pending'";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_array($result)) {


                        if($row['total']==0){

                        }
                        else{
                          echo "<span class='badge text-bg-light'>";
                          echo $row['total'];
                          echo "</span>";
                        }
                        


                      }?></button></div></h1>

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
                        <th scope="col">Carwash</th>
                        <th scope="col">Image</th>

                        <th scope="col">Owner</th>
                        <th scope="col">Username</th>
                        <th scope="col">Location</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created</th>
                        <th scope="col">Suspended</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        date_default_timezone_set('Asia/Manila');

                        // Get the current date and time
                        $time = date('Y-m-d H:i:s');
                        $current_time = new DateTime($time);

                        $sql = "SELECT * FROM carwash WHERE status != 'Pending'";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>".$row['wash_name']."</td>";
                            echo "<td><img src='upload/".$row['image']."' width='50px' style='border-radius:50%;' data-bs-toggle='modal' data-bs-target='#pic".$row['id']."'></td>";
                            echo "<td>".$row['owner']."</td>";
                            echo "<td>".$row['username']."</td>";
                            echo "<td><a class='btn btn-sm' href='viewmap.php?id=".$row['id']."' style='background-color:#1f9acd;color:white;'>View</a></td>";
                            echo "<td>".$row['status']."</td>";
                            echo "<td>".$row['created']."</td>";
                            echo "<td>".$row['suspended']."</td>";

                            if ($row['status'] == "Accepted") {
                                echo "<td><button class='btn btn-sm' style='background-color:#1f9acd;color:white;' data-bs-toggle='modal' data-bs-target='#sus".$row['id']."'>Suspend</button></td>";

                                echo "<div class='modal fade' id='sus".$row['id']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                      <div class='modal-dialog'>
                                        <div class='modal-content'>
                                          <div class='modal-header' style='background-color:#99d5e9;'>
                                            <h1 class='modal-title fs-5' id='exampleModalLabel'>Suspend</h1>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                          </div>
                                          <div class='modal-body'>
                                          <form action='suspendcar.php' method='post'>
                                          <input type='hidden' name='id' value='".$row['id']."'>
                                          <center><img src='sus.png' width='100px'></center>
                                          <center><h5>Are you sure you want to suspend this carwash?</h5></center>
                                          </div>
                                          <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                            <button type='submit' class='btn' style='background-color:#1f9acd;color:white;'>Suspend</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>";
                        } elseif ($row['status'] == "Suspended") {
                            $suspended_time = new DateTime($row['suspended']);
                            $diff = $suspended_time->diff($current_time);
                            $day_diff = $diff->days;

                            // echo "<td>".$day_diff." days</td>";

                            if($day_diff >= 30){
                              echo "<td><button class='btn btn-sm bg-danger' >Remove</button></td>";
                            }
                            else{
                              echo "<td><button class='btn btn-sm' style='background-color:#1f9acd;color:white;' data-bs-toggle='modal' data-bs-target='#sus".$row['id']."'>Continue</button></td>";

                              echo "<div class='modal fade' id='sus".$row['id']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                      <div class='modal-dialog'>
                                        <div class='modal-content'>
                                          <div class='modal-header' style='background-color:#99d5e9;'>
                                            <h1 class='modal-title fs-5' id='exampleModalLabel'>Continue</h1>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                          </div>
                                          <div class='modal-body'>
                                          <form action='continuecar.php' method='post'>
                                          <input type='hidden' name='id' value='".$row['id']."'>
                                          
                                          <center><h5>Are you sure you want to continue this Carwash?</h5></center>
                                          </div>
                                          <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                            <button type='submit' class='btn' style='background-color:#1f9acd;color:white;'>Continue</button>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>";
                            }
                            
                        }

                        echo "</tr>";
                    }
                    ?>

                    
                      
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

    </section>

  </main>




<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content ">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Pending</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-borderless datatable mt-2" id="data-table">
                    <thead>
                      <tr>
                        <th scope="col">Carwash</th>
                        <th scope="col">Image</th>
                        <th scope="col">Owner</th>
                        <th scope="col">Username</th>
                        <th scope="col">Location</th>
                        


                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "select * from carwash where status='Pending'";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>".$row['wash_name']."</td>";
                        echo "<td><img src='upload/".$row['image']."' width='50px' style='border-radius:50%;' data-bs-toggle='modal' data-bs-target='#pic".$row['id']."'></td>";
                        echo "<td>".$row['owner']."</td>";
                        echo "<td>".$row['username']."</td>";
                        echo "<td><a class='btn btn-sm' href='viewmap.php?id=".$row['id']."' style='background-color:#1f9acd;color:white;'>View</a></td>";
                        echo "
                        <td>
                        <a href='accepted.php?id=".$row['id']."' class='btn btn-sm' style='background-color:#1f9acd;color:white;' >Accepted</a>
                        <a href='reject.php?id=".$row['id']."' class='btn btn-sm' style='background-color:#99d5e9;color:white;' >Reject</a>
                        </td>";
                      }
                      ?>
                    </tbody>
                  </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
       
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


