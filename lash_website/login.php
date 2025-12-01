<?php
include 'includes/db.php';
session_start();
$error = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ? LIMIT 1");
  $stmt->bind_param("s",$email);
  $stmt->execute();
  $stmt->store_result();
  if($stmt->num_rows === 1){
    $stmt->bind_result($id,$name,$hash,$role);
    $stmt->fetch();
    if(password_verify($password,$hash)){
      $_SESSION['user_id'] = $id;
      $_SESSION['user_name'] = $name;
      $_SESSION['user_role'] = $role;
      header('Location: dashboard.php');
      exit;
    } else {
      $error = "Incorrect credentials.";
    }
  } else {
    $error = "Incorrect credentials.";
  }
  $stmt->close();
}
include 'includes/header.php';
?>
<div class="container" style="padding:40px 0">
  <h2>Login</h2>
  <div class="card" style="max-width:420px">
    <?php if($error): ?><div class="notice error"><?=htmlspecialchars($error)?></div><?php endif; ?>
    <form method="POST">
      <div class="form-row"><label>Email</label><input type="email" name="email" required></div>
      <div class="form-row"><label>Password</label><input type="password" name="password" required></div>
      <button class="btn" type="submit">Login</button>
      <p style="margin-top:12px;">No account? <a href="register.php">Register</a></p>
    </form>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
