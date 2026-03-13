<?php
require_once('../app/config/config.php');

$id = $_POST['id'];
$title = $_POST['title'];
$author = $_POST['author'];
$total = $_POST['total_qty'];

if($id){

$conn->query("
UPDATE books
SET title='$title',
author='$author',
total_qty='$total'
WHERE id=$id
");

}else{

$conn->query("
INSERT INTO books(title,author,total_qty,available_qty)
VALUES('$title','$author','$total','$total')
");

}

header("Location: book_list.php");