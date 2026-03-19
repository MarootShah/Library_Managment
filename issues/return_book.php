<?php
require_once('../app/config/config.php');

if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

$issue_id = $_GET['id'];

$issue = $conn->query("SELECT * FROM issued_books WHERE id = $issue_id")->fetch_assoc();

if(!$issue){
    die("Record not found");
}

$today = date("Y-m-d");
$due_date = $issue['due_date'];

$fine = 0;
if($today > $due_date){
    $days_late = (strtotime($today) - strtotime($due_date)) / (60*60*24);
    $fine = $days_late * 100;
}

$conn->query("UPDATE issued_books SET return_date = '$today',status = 'returned',fine_amount = $fine WHERE id = $issue_id");

$conn->query("UPDATE books 
    SET available_qty = available_qty + 1 
    WHERE id = ".$issue['book_id']);

header("Location: index.php");
exit();
?>