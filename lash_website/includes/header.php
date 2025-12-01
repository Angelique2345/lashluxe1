<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Lash Luxe</title>
  <link rel="stylesheet" href="css/style.css">
  <script defer src="js/main.js"></script>
</head>
<body>
<header class="site-header">
  <div class="container header-inner">
    <a href="index.php" class="brand">
      <img src="images/logo.png" alt="Lash Luxe Logo" class="logo">
    </a>
    <nav class="nav">
      <a href="index.php">Home</a>
      <a href="about.php">About</a>
      <a href="services.php">Services</a>
      <a href="gallery.php">Gallery</a>
      <a href="booking.php">Booking</a>
      <a href="contact.php">Contact</a>
      <?php if(isset($_SESSION['user_id'])): ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="login.php">Login</a>
      <?php endif; ?>
    </nav>
    <div class="social-small"
      ><a href="https://wa.me/14734173675" target="_blank" aria-label="WhatsApp">WA</a>
      <a href="https://www.instagram.com/_lash_lu_xe_?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" 
   target="_blank" 
   rel="noopener noreferrer">Instagram</a>
</div>
  </div>
</header>
<main>
