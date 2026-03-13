<?php
require_once('../app/config/config.php');

if(!isset($_SESSION["user"])){
    header("Location: ../public/login.php");
    exit();
}

if(isset($_GET['id'])){

    $id = (int)$_GET['id'];

    // delete from students table
    mysqli_query($conn, "DELETE FROM students WHERE stu_id = $id");

    // delete from users table
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");

}

header("Location: student.php");
exit();
?>