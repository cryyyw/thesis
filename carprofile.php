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


    .error-message {
            height: 10px; /* Fixed height for the error message container */
            margin-bottom: 10px;
            margin-top: 10px;

        }
        .blur-image-container {
      position: relative;
      overflow: hidden;
    }

    .blur-image-container img {
      transition: filter 0.5s ease;
    }

    .blur-image-container:hover img {
      filter: blur(5px); /* Adjust the blur amount as needed */
    }
    
    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 89%;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.5s ease;
    }

    .blur-image-container:hover .overlay {
      opacity: 1;
    }
    .edit{
        width: 50px;
        background-color: #0d6efd;
        height: 50px;
        border-radius: 50%;
        border: none;
        color: white;
    }

  </style>
</head>

<body>
  <?php
    include "nav3.php";
  ?>
  
  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Carwash Profile</h1>

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
                <div class="card-body">

                 
                  <div class="container ">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 mt-4">
    <div class="col">

        <center>
                          <div class="blur-image-container" >
                                        <img class="mb-3" src="upload/<?php
                         // session_start();
                        $id =  $_SESSION['id'];
                        $sql = "select * from carwash where id = '$id'";
                          $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo $row['image'];
                                        }
                        ?>" style="width: 250px;border-radius: 50%;">


                                <div class="overlay">
                                    <button class="edit" data-bs-toggle="modal" data-bs-target="#pic"><i class="bi bi-pencil-fill"></i></button>
                                </div>
                            </div></center>
      


    </div>
    <div class="col">
      <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Fullname</label>
    <input type="text" class="form-control" value="<?php
                         // session_start();
                        $id =  $_SESSION['id'];
                        $sql = "select * from carwash where id = '$id'";
                          $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo $row['fullname'];
                                        }
                        ?>" id="exampleInputPassword1" readonly>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Username</label>
    <input type="text" class="form-control" value="<?php
                         // session_start();
                        $id =  $_SESSION['id'];
                        $sql = "select * from carwash where id = '$id'";
                          $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo $row['username'];
                                        }
                        ?>" id="exampleInputPassword1" readonly>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Role</label>
    <input type="text" class="form-control" value="Car Wash" id="exampleInputPassword1" readonly>
  </div>

  <center><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changepass">Change Password</button></center>
    </div>
   
  </div>
</div>

                 

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
<div class="modal fade" id="pic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Profile Picture</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="change123.php" method="post" enctype='multipart/form-data'>



           <center> 

<img src="image.png" width="200px" id="previewImage" style="border-radius: 50%;">

        </center>
         <div class="mb-3">
    <label for="exampleInputtext1" class="form-label">Image</label>
    <input type="file" class="form-control" id="image" accept="image/*" name="logo" onchange="previewFile()" required>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="changepass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="changepasslandlord.php" method="post" enctype='multipart/form-data'>

<input type='hidden' id="old" value="<?php
                         // session_start();
                        $id =  $_SESSION['id'];
                        $sql = "select * from carwash where id = '$id'";
                          $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo $row['password'];
                                        }
                        ?>">
<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Current Password</label>
    <input type="password" class="form-control" onchange="checkpass()" id="current">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">New Password</label>
    <input type="password" class="form-control" onchange="checkpass()" name="new" id="new">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Re-Enter</label>
    <input type="password" class="form-control" onchange="checkpass()" id="re">
  </div>
          
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" disabled id="btn">Save changes</button>
      </form>
      </div>
    </div>
  </div>
</div>

</body>

</html>


<script>
        function previewFile() {
            var preview = document.getElementById('previewImage');
            var fileInput = document.getElementById('image');
            var file = fileInput.files[0];

            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "image.png"; // Default image if no file is selected
            }
        }
        function checkpass() {
    var oldPassword = document.getElementById("old").value;
    var currentPassword = document.getElementById("current").value;
    var newPassword = document.getElementById("new").value;
    var rePassword = document.getElementById("re").value;
    var button = document.getElementById("btn");

    if (oldPassword === currentPassword) {
        if (newPassword === "" || rePassword === "") {
            button.disabled = true;
        } else if (newPassword === rePassword) {
            button.disabled = false;
        } else {
            button.disabled = true;
        }
    } else {
        button.disabled = true;
    }
}

    </script>