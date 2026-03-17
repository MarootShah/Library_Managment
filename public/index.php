<?php
require_once('../app/config/config.php');

if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

/* DATABASE COUNTS */
$books = $conn->query("SELECT COUNT(id) as total FROM books")->fetch_assoc()['total'];
$members = $conn->query("SELECT COUNT(id) as total FROM students")->fetch_assoc()['total'];
$issued = $conn->query("SELECT COUNT(id) as total FROM issued_books WHERE status='issued'")->fetch_assoc()['total'];
$returned = $conn->query("SELECT COUNT(id) as total FROM issued_books WHERE status='returned'")->fetch_assoc()['total'];
?>

<?php if($_SESSION["user"]['role'] == 'admin'){ ?>
<!DOCTYPE html>
<html>
<head>
    <title>Library Dashboard</title>
    <link rel="stylesheet" href="../assests/css/style.css">
</head>
<body class="dashboard-page">

<div class="dashboard">

    <!-- SIDEBAR -->
    <?php include('../includes/sidebar.php'); ?>

    <!-- MAIN -->
    <div class="main">

        <div class="topbar">
            <h2>Library</h2>
            <a class="logout" href="logout.php">Logout</a>
        </div>

        <!-- CARDS -->
        <div class="cards">

            <a class="card-link" href="../books/book_list.php">
                <div class="card blue">
                    <h1><?php echo $books; ?></h1>
                    Books
                </div>
            </a>

            <a class="card-link" href="student.php">
                <div class="card green">
                    <h1><?php echo $members; ?></h1>
                    Students
                </div>
            </a>

            <a class="card-link" href="../issues/issues.php">
                <div class="card orange">
                    <h1><?php echo $issued; ?></h1>
                    Issued
                </div>
            </a>

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

<title>Library Dashboard</title>

<link rel="stylesheet" href="../assests/css/style.css">

</head>

<body class="dashboard-page">

<div class="dashboard">

<!-- SIDEBAR -->
<?php include('../includes/sidebar.php'); ?>

<!-- MAIN -->
<div class="main">

<div class="topbar">

<h2>Library Control Panel</h2>

<a class="logout" href="../public/logout.php">Logout</a>

</div>

<!-- CARDS -->

<div class="cards">

<a class="card-link" href="../books/book_list.php">
<div class="card blue">
<h1><?php echo $books; ?></h1>
Books
</div>
</a>

<a class="card-link" href="issued_list.php">
<div class="card orange">
<h1><?php echo $issued; ?></h1>
Issued
</div>
</a>

<a class="card-link" href="returned.php">
<div class="card red">
<h1><?php echo $returned; ?></h1>
Returned
</div>
</a>

</div>

<?php include('../includes/footer.php'); ?>

</div>

</div>

</body>
</html>
<?php } ?>