<?php
session_start();
include "dbcon.php";
if($_SESSION['role'] == "Admin"){
        header('refresh:1; url= adminmain.php');
}
else if($_SESSION['role']=="Car"){
          header('refresh:1; url= carmain.php');
}
else if($_SESSION['role']=="Customer"){
    header('refresh:1; url= customer.php');
}

?>