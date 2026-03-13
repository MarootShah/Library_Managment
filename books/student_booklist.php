<?php
require_once('../app/config/config.php');

if(!isset($_SESSION["user"])){
header("Location: login.php");
exit();
}

$result = $conn->query("SELECT * FROM books ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>

<title>Books</title>

<link rel="stylesheet" href="../assests/css/style.css">

</head>

<body class="dashboard-page">

<div class="dashboard">

<!-- SIDEBAR -->
<?php include('../includes/studentsidebar.php'); ?>
<!-- MAIN -->

<div class="main">

<div class="topbar">

<h2>Books</h2>

<a class="logout" href="../public/logout.php">Logout</a>

</div>

<div style="padding:30px">

<br><br>

<table class="table">

<tr>
<th>ID</th>
<th>Title</th>
<th>Author</th>
<th>Total</th>
<th>Available</th>  
</tr>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['title']; ?></td>
<td><?php echo $row['author']; ?></td>
<td><?php echo $row['total_qty']; ?></td>
<td><?php echo $row['available_qty']; ?></td>

</tr>

<?php } ?>

</table>

</div>
<?php include('../includes/footer.php'); ?>
</div>

</div>

</body>
</html>