<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add Task</h1>
    <form action="add_task.php" method="post">
        <label for="task_name"><span>Task Name:</span></label>
        <input type="text" id="task_name" name="task_name" required>
        
        <label for="task_description"><span>Task Description:</span></label>
        <textarea id="task_description" name="task_description"></textarea>
        
        <button type="submit">Add Task</button>
    </form>

    <h1>Task List</h1>
    <?php
    // Include database connection
    include 'db_connection.php';

    // Fetch tasks from the database
    $sql = "SELECT * FROM tasks";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<ul>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li>';
            echo '<strong>' . htmlspecialchars($row['task_name']) . '</strong>';
            echo '<p>' . htmlspecialchars($row['task_description']) . '</p>';
            echo '<a href="delete_task.php?id=' . $row['id'] . '">Delete</a>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
    ?>
</body>
</html>
