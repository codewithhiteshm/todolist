<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = $_POST["task"];
    $dueDate = $_POST["due_date"];

    $stmt = $conn->prepare("INSERT INTO tasks (task_name, due_date, completed) VALUES (?, ?, 0)");
    
    if ($stmt) {
        $stmt->bind_param("ss", $task, $dueDate);
        $stmt->execute();

        header("Location: index.php");
        exit();
    } else {
        // Print detailed error information
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
