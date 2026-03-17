<?php
require_once('../app/config/config.php');

if (isset($_SESSION["user"])) {
    header("Location: add_users.php");
    exit();
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name     = trim($_POST["name"] ?? "");
    $email    = trim($_POST["email"] ?? "");
    $phone    = trim($_POST["phone"] ?? "");
    $class    = trim($_POST["class"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm  = $_POST["confirm_password"] ?? "";

    if ($name === "" || $email === "" || $phone === "" || $class === "" || $password === "" || $confirm === "") {
        $msg = "All fields are required.";
    } elseif ($password !== $confirm) {
        $msg = "Passwords do not match.";
    } else {

        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' LIMIT 1");

        if (mysqli_fetch_assoc($check)) {
            $msg = "Email already exists.";
        } else {

            $hash = md5($password);
            $role = "student";

            $query1 = "INSERT INTO users (name, email, password_hash, role, created_at)
                       VALUES ('$name', '$email', '$hash', '$role', NOW())";

            if (mysqli_query($conn, $query1)) {

                $user_id = mysqli_insert_id($conn);

                $query2 = "INSERT INTO students (id, stu_id, phone, class, created_at)
                           VALUES ('', '$user_id', '$phone', '$class', NOW())";

                if (mysqli_query($conn, $query2)) {
                    header("Location: login.php?registered=1");
                    exit();
                } else {
                    $msg = "Student table insert failed.";
                }

            } else {
                $msg = "User registration failed.";
            }
        }
    }
}

include('../includes/header.php');
?>

<div class="login-wrapper">

    <div class="login-left">
        <h1>Admin or Student Registration</h1>
        <p>Create your student account to continue...</p>
    </div>

    <div class="login-box">
        <h2>Register</h2>

        <?php if($msg): ?>
            <div class="error"><?= $msg ?></div>
        <?php endif; ?>

        <form method="post">

            <div class="input-group">
                <input type="text" name="name" required>
                <label>Name</label>
            </div>

            <div class="input-group">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>

            <div class="input-group">
                <input type="text" name="phone" maxlength="10" required>
                <label>Phone</label>
            </div>

            <div class="input-group">
                <input type="text" name="class" required>
                <label>Class</label>
            </div>

            <div class="input-group password-group">
                <input type="password" name="password" id="password" required>
                <label>Password</label>
                <span id="togglePassword" style="cursor:pointer; user-select:none;">Show</span>
            </div>

            <div class="input-group password-group">
                <input type="password" id="confirm_password" name="confirm_password" required>
                <label>Confirm Password</label>
                <span id="toggleConfPassword" style="cursor:pointer; user-select:none;">Show</span>
            </div>

            <button type="submit" class="login-btn">Register »</button>

            <div class="register-link">
                Back to
                <a href="../public/login.php">Login</a>
            </div>

        </form>
    </div>
</div>

<script src="../assests/js/app.js"></script>