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
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo 'Error: ' . mysqli_error($conn);
}
?>
