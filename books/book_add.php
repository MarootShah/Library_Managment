<?php
require_once('../app/config/config.php');

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$title = "";
$author = "";
$total = 1;

if ($id > 0) {
    $q = $conn->query("SELECT * FROM books WHERE id = $id");
    if ($q && $q->num_rows > 0) {
        $row = $q->fetch_assoc();
        $title = $row['title'];
        $author = $row['author'];
        $total = $row['total_qty'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $id > 0 ? "Edit Book" : "Add Book"; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="dashboard-page">

<div class="dashboard">

    <?php include('../includes/sidebar.php'); ?>


    <div class="main">
        <div class="topbar">
            <h2><?php echo $id > 0 ? "Edit Book" : "Add Book"; ?></h2>
            <a class="logout" href="../public/logout.php">Logout</a>
        </div>

        <div class="form-area">
            <div class="book-form-box">
                <h3><?php echo $id > 0 ? "Update Book Details" : "Enter Book Details"; ?></h3>

                <form action="book_save.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <label>Book Title</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" required>

                    <label>Author Name</label>
                    <input type="text" name="author" value="<?php echo htmlspecialchars($author); ?>" required>

                    <label>Total Quantity</label>
                    <input type="number" name="total_qty" value="<?php echo (int)$total; ?>" min="1" required>

                    <div class="form-buttons">
                        <button type="submit" class="save-btn">Save Book</button>
                        <a href="book_list.php" class="cancel-btn">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

</body>
</html>