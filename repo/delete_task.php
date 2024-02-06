<?php
include 'db.php';

// Redirect if delete parameter is not set
if(!isset($_GET['delete'])){
    header("Location: index.php");
    exit();
}

$deleteId = $_GET['delete'];

// Delete task from the database
$conn->query("DELETE FROM tasks WHERE id = $deleteId");

header("Location: index.php");
exit();
