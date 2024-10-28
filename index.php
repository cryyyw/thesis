<?php
  session_start();
  include('dbcon.php');
  
  if (isset($_SESSION['role'])){
    header('location:session.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
    }
    .navbar {
      width: 100%;
      margin: 0;
    }
    .login-card {
      max-width: 400px;
      width: 100%;
      padding: 2rem;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
      background-color: #fff;
      border-radius: 0.5rem;
      margin-top: 120px; /* Increased margin-top */
    }
    .section {
      padding: 100px 15px;
      text-align: center;
    }
    #home {
      background-color: #99d5e9;
      color: white;
    }
    #about {
      background-color: #6c757d;
      color: white;
    }
    #contact {
      background-color: #28a745;
      color: white;
    }
    #signup {
      background-color: #ffc107;
      color: white;
    }
  </style>
</head>
<body>

  <!-- Responsive Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light  fixed-top " style="background-color: #1f9acd;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Clean Connect</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#signup">Sign Up</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Login Card -->
  <div class="login-card mx-auto  mb-5">
    <center><img src="logo.jpg" width="140px"></center>
    <h3 class="text-center mb-4" style="color: #1f9acd;">Login</h3>
    <form action="login.php" method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="username" placeholder="Enter email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
      <div class="mb-3 d-flex justify-content-between">
        <a href="#" class="text-muted">Forgot Password?</a>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn" style="background-color: #1f9acd;color: white;">Login</button>
      </div>
    </form>
    <div class="text-center mt-3">
      <p>Don't have an account? <a href="#signup">Sign Up</a></p>
    </div>
  </div>

  <!-- Sections for each nav item (Placed after login) -->
  <section id="home" class="section">
    <h1>Welcome to MyApp</h1>
    <p>This is the Home section.</p>
  </section>

  <section id="about" class="section">
    <h1>About MyApp</h1>
    <p>Learn more about what we do.</p>
  </section>

  <section id="contact" class="section">
    <h1>Contact Us</h1>
    <p>Get in touch with us for more information.</p>
  </section>

  <section id="signup" class="section">
    <h1>Sign Up</h1>
    <p>Join us by creating a new account.</p>
  </section>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
