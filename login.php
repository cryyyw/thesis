<style>
.gif-container {
  display: flex;
  flex-direction: column; /* Stack the GIF and the text vertically */
  justify-content: center; /* Centers horizontally */
  align-items: center; /* Centers vertically */
  height: 85vh; /* Full height of the viewport */
  border-color: #109ada;
  text-align: center; /* Center the text inside the container */
}

h1 {
  color: #1f9acd;
  margin-top: 20px; /* Adds some spacing between the GIF and the text */
}
</style>

<div class="gif-container">
  <img src="carwash.gif" alt="description-of-gif" />
  <?php
  session_start();
  include "dbcon.php";
  $email = $_POST['username'];
  $pass = $_POST['password'];

  $sql = "SELECT * FROM ( 
          SELECT id, role, username, password 
          FROM admin 
          UNION 
          SELECT id, role, username, password FROM carwash 
          UNION 
          SELECT id, role, username, password 
          FROM customer 
          ) combined_table
          WHERE BINARY username = ? AND BINARY password = ?";
  $stmt = mysqli_prepare($conn, $sql);
  if ($stmt) {
      mysqli_stmt_bind_param($stmt, "ss", $email, $pass);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);
      if ($row && mysqli_num_rows($result) === 1) {
          $_SESSION['role'] = $row['role'];
          $_SESSION['id'] = $row['id'];
          echo "<h1>Welcome to CleanConnect</h1>";
          header('refresh:3; url=session.php');

      } else {
          echo "<h1>Incorrect Credential</h1>";
          header('refresh:3; url=index.php');
      }
  }
  ?>
</div>
