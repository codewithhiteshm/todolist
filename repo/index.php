<?php
include 'db.php';

// Delete task logic
if(isset($_GET['delete'])){
    $deleteId = $_GET['delete'];
    $conn->query("DELETE FROM tasks WHERE id = $deleteId");
}

$result = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List App</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <header>Todo List</header>

        <form action="add_task.php" method="post">
            <label for="task">New Task:</label>
            <input type="text" name="task" required>
            <label for="due_date">Due Date:</label>
            <input type="date" name="due_date">
            <button type="submit">Add Task</button>
        </form>

        <h2>Tasks to Be Done</h2>
        <ul>
            <?php
            while ($row = $result->fetch_assoc()) {
                if (!$row['completed']) {
                    echo "<li>{$row['task_name']} - Due Date: {$row['due_date']} <button class='delete-btn' onclick=\"window.location.href='delete_task.php?delete={$row['id']}'\">Delete</button></li>";
                }
            }
            ?>
        </ul>

        <h2>Completed Tasks</h2>
        <ul>
            <?php
            // Fetch all completed tasks
            $completedResult = $conn->query("SELECT * FROM tasks WHERE completed = 1 ORDER BY created_at DESC");
            while ($completedRow = $completedResult->fetch_assoc()) {
                echo "<li>{$completedRow['task_name']} - Due Date: {$completedRow['due_date']}</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
