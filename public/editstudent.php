<?php
require_once('../app/config/config.php');

if(!isset($_SESSION["user"])){
    header("Location: ../public/login.php");
    exit();
}

$msg = "";

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: student.php");
    exit();
}

$id = (int)$_GET['id'];

/* FETCH STUDENT DATA */
$query = "SELECT users.id, users.name, users.email, students.phone,users.role
          FROM users
          LEFT JOIN students ON users.id = students.stu_id
          WHERE users.id=$id
          LIMIT 1";
$result = mysqli_query($conn, $query);

if(!$result || mysqli_num_rows($result) == 0){
    header("Location: student.php");
    exit();
}

$row = mysqli_fetch_assoc($result);

/* UPDATE STUDENT */
if($_SERVER["REQUEST_METHOD"] === "POST"){

    $name  = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);

    if($name == "" || $email == "" || $phone == ""){
        $msg = "All fields are required.";
    } else {

        $name  = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $phone = mysqli_real_escape_string($conn, $phone);

        $check = "SELECT id FROM users WHERE email='$email' AND id != $id LIMIT 1";
        $check_result = mysqli_query($conn, $check);

        if(mysqli_num_rows($check_result) > 0){
            $msg = "Email already exists.";
        } else {

            $update1 = "UPDATE users 
                        SET name='$name', email='$email' 
                        WHERE id=$id";

            $update2 = "UPDATE students 
                        SET phone='$phone' 
                        WHERE stu_id=$id";

            if(mysqli_query($conn, $update1) && mysqli_query($conn, $update2)){
                header("Location: student.php");
                exit();
            } else {
                $msg = "Update failed.";
            }
        }
    }
}

?>
<?php if($row['role'] == 'admin'){ ?>
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
            <h2>Edit User</h2>
            <a class="logout" href="../public/logout.php">Logout</a>
        </div>

        <div class="form-box">

            <?php if($msg != ""){ ?>
                <p class="error"><?php echo $msg; ?></p>
            <?php } ?>

            <form method="POST">

                <label>Name</label>
                <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

                <label>Email</label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

                
                <button type="submit">Update Student</button>

            </form>

        </div>

        <?php include('../includes/footer.php'); ?>

    </div>

</div>

</body>
</html>
<?php }else{ ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="../assests/css/style.css">
</head>
<body class="dashboard-page">

<div class="dashboard">

    <?php include('../includes/sidebar.php'); ?>

    <div class="main">

        <div class="topbar">
            <h2>Edit User</h2>
            <a class="logout" href="../public/logout.php">Logout</a>
        </div>

        <div class="form-box">

            <?php if($msg != ""){ ?>
                <p class="error"><?php echo $msg; ?></p>
            <?php } ?>

            <form method="POST">

                <label>Name</label>
                <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

                <label>Email</label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>

                <button type="submit">Update User</button>

            </form>

        </div>

        <?php include('../includes/footer.php'); ?>

    </div>

</div>

</body>
</html>
<?php } ?>