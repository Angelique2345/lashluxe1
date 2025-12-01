<?php
include 'includes/db.php';
session_start();
if(!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
include 'includes/header.php';
?>
<div class="container" style="padding:40px 0">
  <h2>Dashboard</h2>
  <p>Welcome back, <?=htmlspecialchars($_SESSION['user_name'])?>.</p>

  <h3>Your Bookings</h3>
  <?php
  $stmt = $conn->prepare("SELECT id, service, appointment_date, appointment_time, created_at FROM bookings WHERE user_id = ? ORDER BY appointment_date DESC");
  $stmt->bind_param("i", $_SESSION['user_id']);
  $stmt->execute();
  $res = $stmt->get_result();
  if($res->num_rows > 0){
      while($row = $res->fetch_assoc()){
          echo "<div class='card' style='margin-bottom:12px;'><strong>".htmlspecialchars($row['service'])."</strong> - ".htmlspecialchars($row['appointment_date'])." ".htmlspecialchars($row['appointment_time'])."</div>";
      }
  } else {
      echo "<p>No bookings yet. <a href='booking.php'>Make one</a></p>";
  }
  $stmt->close();
  ?>
</div>
<?php include 'includes/footer.php'; ?>
