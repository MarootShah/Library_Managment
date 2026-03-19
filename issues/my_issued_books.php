<?php
require_once('../app/config/config.php');

if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION["user"]['id'];

$result = $conn->query("SELECT issued_books.*, books.title AS book_name FROM issued_books LEFT JOIN books ON issued_books.book_id = books.id WHERE issued_books.student_id = '$student_id'
ORDER BY issued_books.id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>My Issued Books</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="dashboard-page">

<div class="dashboard">

<?php include('../includes/sidebar.php'); ?>

<div class="main">

<div class="topbar">
<h2>My Issued Books</h2>
<a class="logout" href="../public/logout.php">Logout</a>
</div>

<div style="padding:30px">

<table class="issue-table">

<tr>
<th>ID</th>
<th>Book Name</th>
<th>Issue Date</th>
<th>Due Date</th>
<th>Status</th>
</tr>

<?php while($row = $result->fetch_assoc()) { 

    $fine = 0;

    if($row['status'] == 'issued'){
        $today = date("Y-m-d");

    }
?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['book_name']; ?></td>
<td><?php echo $row['issue_date']; ?></td>
<td><?php echo $row['due_date']; ?></td>
<td><?php echo $row['status']; ?></td>
</tr>
<?php } ?>
</table>
</div>
<?php include('../includes/footer.php'); ?>
</div>
</div>
</body>
</html>