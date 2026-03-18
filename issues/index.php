<?php
require_once('../app/config/config.php');

if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

// Fetch issued books
$result = $conn->query("SELECT issued_books.*, users.name AS student_name, books.title AS book_name FROM issued_books LEFT JOIN users 
ON issued_books.student_id = users.id LEFT JOIN books ON issued_books.book_id = books.id ORDER BY issued_books.id DESC");
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
<th>Student Name</th>
<th>Book Name</th>
<th>Issue Date</th>
<th>Due Date</th>
<th>Return Date</th>
<th>Status</th>
<th>Fine</th>
<th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['student_name']; ?></td>
<td><?php echo $row['book_name']; ?></td>
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