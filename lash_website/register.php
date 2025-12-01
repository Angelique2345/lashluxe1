<?php
include 'includes/db.php';
session_start();
$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $password2 = $_POST['password2'];
  if($password !== $password2) $errors[] = "Passwords do not match.";
  if(strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";

  if(empty($errors)){
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
    $stmt->bind_param("sss",$name,$email,$hash);
    if($stmt->execute()){
      $_SESSION['user_id'] = $stmt->insert_id;
      $_SESSION['user_name'] = $name;
      header('Location: dashboard.php');
      exit;
    } else {
      $errors[] = "Error registering (email may already be used).";
    }
    $stmt->close();
  }
}

include 'includes/header.php';
?>
<div class="container" style="padding:40px 0">
  <h2>Create Account</h2>
  <div class="card" style="max-width:480px">
    <?php if(!empty($errors)): foreach($errors as $err): ?>
      <div class="notice error"><?=htmlspecialchars($err)?></div>
    <?php endforeach; endif; ?>
    <form method="POST">
      <div class="form-row"><label>Name</label><input type="text" name="name" required></div>
      <div class="form-row"><label>Email</label><input type="email" name="email" required></div>
      <div class="form-row"><label>Password</label><input type="password" name="password" required></div>
      <div class="form-row"><label>Confirm password</label><input type="password" name="password2" required></div>
      <button class="btn" type="submit">Register</button>
    </form>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
