<?php
// Include database connection
include 'db_connection.php';

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];

    // Delete task from the database
    $sql = "DELETE FROM tasks WHERE id = $taskId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Location: index.php'); // Redirect back to the main page
        exit();
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>
