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
      <h1 style="color:#3d97b9;">Blocked Users </h1>

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
      <th scope="col">No</th>

      <th scope="col">Customer</th>
      <th scope="col">Gender</th>



      <th scope="col">Status</th>
      <th scope="col">Action</th>

      

    </tr>
  </thead>
  <tbody>
    <?php
    $n = 1;
    $id = $_SESSION['id']; // The carwash ID from session
    $sql = "SELECT c.id, 
    c.fullname,

      c.gender,
    b.block, 

    GROUP_CONCAT(b.car ORDER BY b.car) AS car 
    FROM block AS b 
    RIGHT JOIN customer AS c ON c.id = b.name 
    GROUP BY c.fullname, b.block, b.name;";

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$n."</td>";
        $n++;

        echo "<td>".$row['fullname']."</td>";
        echo "<td>".$row['gender']."</td>";
        $carArray = explode(',', $row['car']);
        if(in_array($id, $carArray)){
            echo "<td>Blocked</td>";
            echo "<td><center><button class='btn btn-sm  btn-secondary ' style='width:100px' data-bs-toggle='modal' data-bs-target='#Modal1".$row['id']."'>Unblocked</button></center></td>";
             echo "<div class='modal fade' id='Modal1".$row['id']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                      <div class='modal-content'>
                        <div class='modal-header bg-secondary text-white'>
                          <h1 class='modal-title fs-5' id='exampleModalLabel'>Unblocked</h1>
                          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                          <form action='carwashunblocked.php' method='post'>
                          <input type='hidden' name='id' value ='".$row['id']."'>
                          <center>Are you sure you want to unblock this user?</center>
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                          <button type='submit' class='btn btn-secondary'>Unblocked</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>";
        } else {
            echo "<td></td>";
            echo "<td><center><button class='btn btn-sm btn-danger ' style='width:100px' data-bs-toggle='modal' data-bs-target='#Modal1".$row['id']."'> Block &nbsp;</button></center></td>";
             echo "<div class='modal fade' id='Modal1".$row['id']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                      <div class='modal-content'>
                        <div class='modal-header bg-danger text-white'>
                          <h1 class='modal-title fs-5' id='exampleModalLabel'>Block</h1>
                          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                          <form action='carwashblocked.php' method='post'>
                          <input type='hidden' name='id' value ='".$row['id']."'>
                          <center>Are you sure you want to block this user?</center>
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                          <button type='submit' class='btn btn-danger'>Block</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>";
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


