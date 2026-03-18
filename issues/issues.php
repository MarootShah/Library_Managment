<?php
require_once('../app/config/config.php');

if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

// GET book id
if(isset($_GET['id'])){
    
    $book_id = $_GET['id'];
    $student_id = $_SESSION["user"]['id'];

    // Get book (ONLY selected book)
    $result = $conn->query("SELECT * FROM books WHERE id = $book_id");

    // Option 3: loop
    while($book = mysqli_fetch_array($result)){

        // Check availability
        if($book['available_qty'] > 0){

            $issue_date = date("Y-m-d");
            $due_date = date("Y-m-d", strtotime("+30 days"));

            // Insert into issued_books
            $conn->query("INSERT INTO issued_books 
            (student_id, book_id, issue_date, due_date, status, fine_amount) 
            VALUES ('$student_id', '$book_id', '$issue_date', '$due_date', 'issued', 0)");

            // Reduce available quantity
            $conn->query("UPDATE books SET available_qty = available_qty - 1  WHERE id = $book_id");
        }
    }
}

// Redirect back
header("Location: ../books/book_list.php");
exit();
?>