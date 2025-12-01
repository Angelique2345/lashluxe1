<?php
include 'includes/db.php';
include 'includes/header.php';
$success = '';
$error = ''; // Initialize $error variable

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $subject = trim($_POST['subject']);
  $message = trim($_POST['message']);

  $stmt = $conn->prepare("INSERT INTO messages (name,email,subject,message) VALUES (?,?,?,?)");
  $stmt->bind_param("ssss",$name,$email,$subject,$message);
  
  if($stmt === false) { // Check if the prepare step failed (e.g., table missing)
      $error = "Prepare failed: " . $conn->error;
  } elseif($stmt->execute()){
      $success = "Thanks — your message has been sent!";
  } else {
      // THIS IS THE CRITICAL DEBUGGING LINE
      $error = "Error saving message: " . $stmt->error;
  }
  
  if($stmt !== false) {
    $stmt->close();
  }
}
?>
<div class="container" style="padding:40px 0">
  <h2>Contact Us</h2>
  <?php if($success): ?><div class="notice success"><?=$success?></div><?php endif; ?>
  <?php if($error): ?><div class="notice error"><?=$error?></div><?php endif; ?> 
  <div class="card" style="max-width:700px;">
    <form method="POST">
      <div class="form-row"><label>Name</label><input type="text" name="name" required></div>
      <div class="form-row"><label>Email</label><input type="email" name="email" required></div>
      <div class="form-row"><label>Subject</label><input type="text" name="subject"></div>
      <div class="form-row"><label>Message</label><textarea name="message" rows="5" required></textarea></div>
      <button class="btn" type="submit">Send Message</button>
    </form>
  </div>
</div>
<?php include 'includes/footer.php'; ?>

