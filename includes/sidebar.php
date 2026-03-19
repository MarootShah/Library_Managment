<?php if($_SESSION["user"]['role'] == 'admin'){ ?>
<div class="sidebar">
    <h2>Library Management</h2>

    <ul>
        <li><a href="../public/index.php">Dashboard</a></li>
        <li><a href="../books/book_list.php">Books</a></li>
        <li><a href="../public/student.php">Users</a></li>
        <li><a href="../issues/index.php">Issued</a></li>
        <li><a href="../public/add_users.php">Add Users</a></li>
    </ul>
</div>
<?php }else{ ?>
<div class="sidebar">

<h2>Library Management</h2>

<ul>
<li><a href="../public/index.php">Dashboard</a></li>
<li><a href="../books/book_list.php">Books</a></li>
<li><a href="../issues/my_issued_books.php">Issued</a></li>
<li><a href="../issues/return.php">Returned</a></li>
<li><a href="#">Not Returned</a></li>
</ul>

</div>

<?php } ?>