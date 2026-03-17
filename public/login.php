<?php
require_once('../app/config/config.php');
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}
// Check if the user is already logged in

// ... rest of your login logic and HTML form goes here ...

$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $email = trim($_POST["email"] ?? "");
  $pass  = $_POST["password"] ?? "";

  $email = mysqli_real_escape_string($conn, $email);

  $query = "SELECT id,name,password_hash,role FROM users WHERE email='$email' LIMIT 1";
  
  $res = mysqli_query($conn, $query);



  if ($row = mysqli_fetch_assoc($res)) {
    if (md5($pass) == $row["password_hash"]) {
      session_start();  
      $_SESSION["user"] = $row;
      header("Location: index.php");
      exit();
    }
  }

  $msg = "Invalid email or password.";
}

include('../includes/header.php');
?>

<div class="login-wrapper">

  <div class="login-left">
    <h1>Welcome to the Library System</h1>
    <p>Log in to continue...</p>
  </div>

  <div class="login-box">
    <h2>Log in</h2>

    <?php if($msg): ?>
      <div class="error"><?= $msg ?></div>
    <?php endif; ?>
        
        <form method="post">
            <div class="input-group">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>

          <div class="input-group password-group">
    <input type="password" name="password" id="password" required>
    <label>Password</label>
    <span id="togglePassword" style="cursor:pointer; user-select:none;">Show</span>
</div>
            <button type="submit" class="login-btn">Log in »</button>

            <div class="register-link">
                Don't have an account?
                <a href="register.php">Register Now</a>
            </div>
        </form>
    
    </div>
</div>

<script src="../assests/js/app.js"></script>