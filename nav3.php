<header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #3d97b9;">

    <div class="d-flex align-items-center justify-content-between">
      <a href="carmain.php" class="logo d-flex align-items-center">
        <img src="logooo.png" alt="">
        <span class="d-none d-lg-block" style="color: #FFFFFF;">Clean Connect</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn" style="color: #FFFFFF;"></i>
    </div><!-- End Logo -->

    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" id="notifDropdown">
  <i class="bi bi-bell"></i>
  <span class="badge bg-primary badge-number" id="notifCount"></span>
</a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have <?php

              $id = $_SESSION['id'];

              $sql = "select count(id) as count from carwash_notif where car = '$id' and readd=''";
              $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                          echo $row['count'];
                                        }


            ?> new notifications
              <a href="carnotif.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
              
            <?php

              $id = $_SESSION['id'];

              $sql = "select * from carwash_notif where car = '$id' and readd='' order by id desc";
              $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                          echo " <li>
              <hr class='dropdown-divider'>
            </li>

            <li class='notification-item'>
              <i class='bi bi-x-circle text-danger'></i>
              <div>
                
                <p>".$row['message']."</p>
                <p>".$row['date']."</p>
              </div>
            </li>";
                                        }


            ?>
          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    // Function to fetch notification count
    function fetchNotificationCount() {
      $.ajax({
        url: 'get_notification_count2.php', // The PHP script to get the count
        type: 'GET',
        dataType: 'json',
        success: function(count) {
          // If there are notifications, show the badge
          if (count > 0) {
            $('#notifCount').text(count);
          } else {
            $('#notifCount').text(''); // Remove the badge if no notifications
          }
        }
      });
    }

    // Call the function when the page loads
    fetchNotificationCount();

    // Periodically fetch notification count (every 10 seconds)
    setInterval(fetchNotificationCount, 10000);

    // Update the notifications to read when dropdown is clicked
    $('#notifDropdown').on('click', function() {
      $.ajax({
        url: 'update_notifications2.php', // Update notifications as read
        type: 'POST',
        success: function(response) {
          console.log(response); // For debugging
          // Optionally refresh the count after marking as read
          fetchNotificationCount();
        }
      });
    });
  });
</script>

        
      

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="upload/<?php
                         // session_start();
                        $id =  $_SESSION['id'];
                        $sql = "select * from carwash where id = '$id'";
                          $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo $row['image'];
                                        }
                        ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2" style="color: #FFFFFF;"><?php
                         // session_start();
                        $id =  $_SESSION['id'];
                        $sql = "select * from carwash where id = '$id'";
                          $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo $row['fullname'];
                                        }
                        ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php
                         // session_start();
                        $id =  $_SESSION['id'];
                        $sql = "select * from carwash where id = '$id'";
                          $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo $row['fullname'];
                                        }
                        ?></h6>
              <span>Carwash</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="carprofile.php" >
                <i class="bi bi-box-arrow-right"></i>
                <span>Profile</span>
              </a>
            </li>
            </li>
             <li>
              <hr class="dropdown-divider">
            </li>
           

            
          

            
          

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="carmain.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
     
      <li class="nav-item">
        <a class="nav-link collapsed"  data-bs-toggle="collapse" href="#collapseExample" role="button">
             <i class="bi bi-person-lines-fill"></i>
          <span>Requests</span>
        </a>
        <div class="collapse" id="collapseExample">
          <a class="nav-link collapsed" href="carpending.php">
            <span style="margin-right: 20px;"></span>
          <i class="bi bi-card-list"></i>
          <span>Request</span>
          </a>
          <a class="nav-link collapsed" href="carrejected.php">
            <span style="margin-right: 20px;"></span>
          <i class="bi bi-x-circle"></i>
          <span>Rejected</span>
          </a>
         <a class="nav-link collapsed" href="carcompleted.php">
          <span style="margin-right: 20px;"></span>
          <i class="bi bi-check-circle-fill"></i>
          <span>Completed</span>
        </a>
     
</div>
      </li>
    

      <li class="nav-item">
        <a class="nav-link collapsed" href="services.php">
                      <i class="bi bi-people-fill"></i>

          <span>Services</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="carblockuser.php">
          <i class="bi bi-arrow-clockwise"></i>
          <span>Block User </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="carreports.php">
            <i class="bi bi-card-list"></i>
          <span>Report</span>
        </a>
      </li>
       <li class="nav-item">
        <a class="nav-link collapsed" href="carratings.php">
            <i class="bi bi-card-list"></i>
          <span>Ratings</span>
        </a>
      </li>

     
     
    

      

      


     

      

      

    </ul>

  </aside><!-- End Sidebar-->