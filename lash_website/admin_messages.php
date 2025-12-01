<?php
include 'includes/db.php';
session_start();
if(!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin'){
  header('Location: login.php');
  exit;
}
include 'includes/header.php';
?>
<div class="container" style="padding:40px 0">
  <h2>Admin — Messages</h2>
  <?php
  $res = $conn->query("SELECT id, name, email, subject, message, created_at FROM messages ORDER BY created_at DESC");
  if($res->num_rows > 0){
    while($m = $res->fetch_assoc()){
      echo "<div class='card' style='margin-bottom:12px;'><strong>".htmlspecialchars($m['name'])." — ".htmlspecialchars($m['subject'])."</strong><p>".nl2br(htmlspecialchars($m['message']))."</p><small>".htmlspecialchars($m['email'])." • ".htmlspecialchars($m['created_at'])."</small></div>";
    }
  } else {
    echo "<p>No messages yet.</p>";
  }
  ?>
</div>
<?php include 'includes/footer.php'; ?>
