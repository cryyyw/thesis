<header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #3d97b9;">

    <div class="d-flex align-items-center justify-content-between">
      <a href="customer.php" class="logo d-flex align-items-center">
     
        <span class="d-none d-lg-block" style="color: #FFFFFF;">Clean Connect</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn" style="color: #FFFFFF;"></i>
    </div><!-- End Logo -->

    

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        

        
      

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="upload/<?php
                         // session_start();
                        $id =  $_SESSION['id'];
                        $sql = "select * from customer where id = '$id'";
                          $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo $row['image'];
                                        }
                        ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2" style="color: #FFFFFF;"><?php
                         // session_start();
                        $id =  $_SESSION['id'];
                        $sql = "select * from customer where id = '$id'";
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
                        $sql = "select * from customer where id = '$id'";
                          $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo $row['fullname'];
                                        }
                        ?></h6>
              <span>Customer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
             <li>
             <li>
              <a class="dropdown-item d-flex align-items-center" >
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
        <a class="nav-link collapsed" href="customer.php">
          <i class="bi bi-grid"></i>
          <span>Map</span>
        </a>
      </li><!-- End Dashboard Nav -->
     
      <li class="nav-item">
        <a class="nav-link collapsed" href="customerrequesst.php">
             <i class="bi bi-person-lines-fill"></i>
          <span>Request</span>
        </a>
      </li>

     
     
      <li class="nav-item">
        <a class="nav-link collapsed" href="Announcement.php">
            <i class="bi bi-card-list"></i>
          <span>Announcement</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="customerhistory.php">
            <i class="bi bi-card-list"></i>
          <span>History</span>
        </a>
      </li>

     
     
      

      

      


     

      

      

    </ul>

  </aside><!-- End Sidebar-->