<header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #3d97b9;">

    <div class="d-flex align-items-center justify-content-between">
      <a href="adminmain.php" class="logo d-flex align-items-center">
        <img src="logooo.png" alt="">
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
                        $sql = "select * from admin where id = '$id'";
                          $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo $row['image'];
                                        }
                        ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2" style="color: #FFFFFF;"><?php
                         // session_start();
                        $id =  $_SESSION['id'];
                        $sql = "select * from admin where id = '$id'";
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
                        $sql = "select * from admin where id = '$id'";
                          $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo $row['fullname'];
                                        }
                        ?></h6>
              <span>Admin</span>
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
        <a class="nav-link collapsed" href="adminmain.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
     
      <li class="nav-item">
        <a class="nav-link collapsed" href="carwash.php">
             <i class="bi bi-person-lines-fill"></i>
          <span>CarWash List</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="user.php">
                      <i class="bi bi-people-fill"></i>

          <span>User List</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="blockuser.php">
          <i class="bi bi-arrow-clockwise"></i>
          <span>Block User </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="reports.php">
            <i class="bi bi-card-list"></i>
          <span>Report</span>
        </a>
      </li>

     
      <li class="nav-item">
        <a class="nav-link collapsed" href="maps.php">
          <i class="bi bi-map"></i>
          <span>Map</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="settings.php">
         <i class="bi bi-gear"></i>
          <span>Settings</span>
        </a>
      </li>

      

      


     

      

      

    </ul>

  </aside><!-- End Sidebar-->