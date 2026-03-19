<?php
require_once "helpers.php";
require_admin();

$res = $conn->query("SELECT b.title, s.name, ib.due_date FROM issued_books ib JOIN books b ON b.id = ib.book_id JOIN students s ON s.id = ib.student_id WHERE ib.status='issued' AND ib.due_date < CURDATE()");
?>

<!DOCTYPE html>
<html>
<head>
<title>Due Books</title>
<link rel="stylesheet" href="/library/assets/style.css">
</head>

<body>

<h2>Due Books</h2>

<table class="table">

<tr>
<th>Book</th>
<th>Student</th>
<th>Due Date</th>
</tr>

<?php while($r = $res->fetch_assoc()) { ?>

<tr>
<td><?php echo e($r["title"]); ?></td>
<td><?php echo e($r["name"]); ?></td>
<td><?php echo e($r["due_date"]); ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>