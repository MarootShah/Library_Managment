<?php
require_once('../app/config/config.php');

if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

// Fetch issued books
$result = $conn->query("SELECT * FROM issued_books ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Issued Books</title>
<link rel="stylesheet" href="../assests/css/style.css">
</head>

<body class="dashboard-page">

<div class="dashboard">

<?php include('../includes/sidebar.php'); ?>

<div class="main">

<div class="topbar">
<h2>Issued Books</h2>
<a class="logout" href="../public/logout.php">Logout</a>
</div>

<div style="padding:30px">

<table class="issue-table">

<tr>
<th>ID</th>
<th>Student ID</th>
<th>Book ID</th>
<th>Issue Date</th>
<th>Due Date</th>
<th>Return Date</th>
<th>Status</th>
<th>Fine</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['student_id']; ?></td>
<td><?php echo $row['book_id']; ?></td>
<td><?php echo $row['issue_date']; ?></td>
<td><?php echo $row['due_date']; ?></td>
<td><?php echo $row['return_date']; ?></td>
<td><?php echo $row['status']; ?></td>
<td><?php echo $row['fine_amount']; ?></td>

<td>
<?php if($row['status'] == 'issued'){ ?>
    <a href="return_book.php?id=<?php echo $row['id']; ?>" 
       onclick="return confirm('Return this book?')">
       🔄 Return
    </a>
<?php } else { ?>
    ✔ Returned
<?php } ?>
</td>

</tr>

<?php } ?>

</table>

</div>

<?php include('../includes/footer.php'); ?>

</div>
</div>

</body>
</html>