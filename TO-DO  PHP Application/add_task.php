<?php
// Include database connection
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $taskName = $_POST['task_name'];
    $taskDescription = $_POST['task_description'];

    // Insert task into the database
    $sql = "INSERT INTO tasks (task_name, task_description) VALUES ('$taskName', '$taskDescription')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Location: index.php'); // Redirect back to the main page
        exit();
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>
