<?php
require_once('../app/config/config.php');

if(!isset($_SESSION["user"])){
    header("Location: ../public/login.php");
    exit();
}

$msg = "";

if(!isset($_GET['id'])){
    header("Location: student.php");
    exit();
}

$id = (int)$_GET['id'];

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $password = $_POST['password'];

    if($password == ""){
        $msg = "Password cannot be empty";
    }else{

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE users 
                  SET password_hash='$hash' 
                  WHERE id=$id";

        if(mysqli_query($conn,$query)){
            header("Location: student.php");
            exit();
        }else{
            $msg = "Update failed";
        }

    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Student</title>

<link rel="stylesheet" href="../assests/css/style.css">

</head>

<body class="dashboard-page">

<div class="dashboard">

<?php include('../includes/sidebar.php'); ?>

<div class="main">

<div class="topbar">

<h2>Change User Password</h2>

<a class="logout" href="../public/logout.php">Logout</a>

</div>

<div class="form-box">

<?php if($msg != ""){ ?>
<p class="error"><?php echo $msg; ?></p>
<?php } ?>

<form method="POST">

<label>New Password</label>

<input type="password" name="password" placeholder="Enter new password" required>

<button type="submit">Update Password</button>

</form>

</div>

<?php include('../includes/footer.php'); ?>

</div>

</div>

</body>
</html>