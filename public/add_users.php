<?php
require_once('../app/config/config.php');

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION["user"]['role'] != 'admin') {
    echo "Access denied";
    exit();
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name     = trim($_POST["name"] ?? "");
    $email    = trim($_POST["email"] ?? "");
    $phone    = trim($_POST["phone"] ?? "");
    $class    = trim($_POST["class"] ?? "");
    $role     = trim($_POST["role"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm  = $_POST["confirm_password"] ?? "";

    if ($name === "" || $email === "" || $password === "" || $confirm === "" || $role === "") {
        $msg = "All fields are required.";
    } elseif ($password !== $confirm) {
        $msg = "Passwords do not match.";
    } elseif ($role === "student" && ($phone === "" || $class === "")) {
        $msg = "Phone and class are required for student.";
    } else {

        $email = mysqli_real_escape_string($conn, $email);
        $name  = mysqli_real_escape_string($conn, $name);
        $phone = mysqli_real_escape_string($conn, $phone);
        $class = mysqli_real_escape_string($conn, $class);
        $role  = mysqli_real_escape_string($conn, $role);

        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' LIMIT 1");

        if (mysqli_fetch_assoc($check)) {
            $msg = "Email already exists.";
        } else {

            $hash = md5($password);

            $query1 = "INSERT INTO users (name, email, password_hash, role, created_at)
                       VALUES ('$name', '$email', '$hash', '$role', NOW())";

            if (mysqli_query($conn, $query1)) {

                $user_id = mysqli_insert_id($conn);

                if ($role === "student") {
                    $query2 = "INSERT INTO students (stu_id, phone, class, created_at)
                               VALUES ('$user_id', '$phone', '$class', NOW())";

                    if (!mysqli_query($conn, $query2)) {
                        $msg = "Student details insert failed.";
                    } else {
                        header("Location: index.php?added=1");
                        exit();
                    }
                } else {
                    header("Location: index.php?added=1");
                    exit();
                }

            } else {
                $msg = "User add failed.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="dashboard-page">

<div class="dashboard">

    <?php include('../includes/sidebar.php'); ?>

    <div class="main">

        <div class="topbar">
            <h2>Add User</h2>
            <a class="logout" href="logout.php">Logout</a>
        </div>

        <div class="adduser-wrapper">

            <div class="adduser-box">

                <?php if ($msg): ?>
                    <div class="error"><?= $msg ?></div>
                <?php endif; ?>

                <form method="post">
                    <div class="form-grid">

                        <div class="input-group">
                            <input type="text" name="name" required>
                            <label>Name</label>
                        </div>

                        <div class="input-group">
                            <input type="email" name="email" required>
                            <label>Email</label>
                        </div>

                        <div class="input-group">
                            <select name="role" id="role" required>
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="student">Student</option>
                            </select>
                        </div>

                        <div class="input-group student-field">
                            <input type="number" name="phone" id="phone" maxlength="10">
                            <label>Phone</label>
                        </div>

                        <div class="input-group student-field">
                            <input type="text" name="class" id="class">
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
                    </div>

                    <button type="submit" class="login-btn">Add User »</button>
                </form>
            </div>
        </div>

        <?php include('../includes/footer.php'); ?>
    </div>
</div>
<script src="../assets/js/app.js"></script>
                </body>
                </html>