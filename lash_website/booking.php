<?php
include 'includes/db.php';
session_start();

$success = '';
$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $full_name = trim($_POST['full_name']);
    $phone = trim($_POST['phone']);
    $service = trim($_POST['service']);
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $notes = trim($_POST['notes']);
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, full_name, phone, service, appointment_date, appointment_time, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $user_id, $full_name, $phone, $service, $appointment_date, $appointment_time, $notes);
    if($stmt->execute()){
        $success = "Booking received! We'll contact you to confirm.";
    } else {
        $error = "Error saving booking. Please try again.";
    }
    $stmt->close();
}
include 'includes/header.php';
?>
<div class="container" style="padding:40px 0">
  <h2>Book an Appointment</h2>
  <div class="card" style="max-width:700px;">
    <?php if($success): ?><div class="notice success"><?=$success?></div><?php endif; ?>
    <?php if($error): ?><div class="notice error"><?=$error?></div><?php endif; ?>

    <form id="booking-form" method="POST">
      <div class="form-row">
        <label>Full name</label>
        <input type="text" name="full_name" required>
      </div>
      <div class="form-row">
        <label>Phone</label>
        <input type="text" name="phone" required>
      </div>
      <div class="form-row">
        <label>Service</label>
        <select name="service" required>
          <option>Classic Lashes</option>
          <option>Volume Lashes</option>
          <option>Hybrid</option>
          <option>Lash Lift</option>
        </select>
      </div>
      <div class="form-row">
        <label>Date</label>
        <input type="date" name="appointment_date" required>
      </div>
      <div class="form-row">
        <label>Time</label>
        <input type="time" name="appointment_time">
      </div>
      <div class="form-row">
        <label>Notes</label>
        <textarea name="notes" rows="3"></textarea>
      </div>
      <button class="btn" type="submit">Request Booking</button>
    </form>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
