<?php
require_once('../app/config/config.php');

if(!isset($_SESSION["user"])){
    header("Location: ../public/login.php");
    exit();
}
$query = "SELECT users.id,users.name,users.email,students.phone,students.class,users.role,users.created_at 
FROM users 
LEFT JOIN students ON users.id = students.stu_id
ORDER BY users.id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>

<title>Students</title>

<link rel="stylesheet" href="../assests/css/style.css">

</head>

<body class="dashboard-page">

<div class="dashboard">

<!-- SIDEBAR -->
<?php include('../includes/sidebar.php'); ?>

<!-- MAIN -->
<div class="main">

<!-- TOPBAR -->
<div class="topbar">

<h2>Registered Students</h2>

<a class="logout" href="../public/logout.php">Logout</a>

</div>

<!-- STUDENT TABLE -->

<table class="student-table">

<thead>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Class</th>
<th>Role</th>
<th>Joined</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone'] ? $row['phone'] : '-' ; ?></td>

<td><?php echo $row['class'] ? $row['class'] : '-' ; ?></td>

<td><?php echo $row['role']; ?></td>

<td><?php echo $row['created_at']; ?></td>

<td>
    <a class="edit-btn" title="Edit" href="editstudent.php?id=<?php echo $row['id']; ?>">📝</a>
    <a class="edit-btn" title="Change Password" href="studentedit.php?id=<?php echo $row['id']; ?>">🔐</a>
    <a class="delete-btn" title="Delete" href="student_delete.php?id=<?php echo $row['id']; ?>" 
       onclick="return confirm('Are you sure you want to delete this student?');">
       🗑️
    </a>
</td>
</tr>

<?php } ?>

</tbody>

</table>

<?php include('../includes/footer.php'); ?>

</div>

</div>

</body>
</html>