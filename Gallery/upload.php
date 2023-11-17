<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'gallary_db';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<?php
// Check if the form has been submitted via POST and an image file is set in the request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {

    // Get the caption from the POST data or set it to an empty string if not provided
    $caption = $_POST['caption'] ?? '';

    // Retrieve the name and temporary location of the uploaded image file
    $file_name = $_FILES['image']['name'];
    $file_temp = $_FILES['image']['tmp_name'];

    // Specify the directory where the uploaded files will be stored
    $upload_dir = 'uploads/';

    // Create the full target path by combining the upload directory and file name
    $target_path = $upload_dir . $file_name;

    // Move the uploaded file to the specified target path
    if (move_uploaded_file($file_temp, $target_path)) {

        // If the file is successfully moved, insert the file details into the database
        $sql = "INSERT INTO images (filename, caption) VALUES ('$file_name', '$caption')";
        mysqli_query($conn, $sql);

        // Redirect to the gallery page after successful upload and database insertion
        header("Location: gallery.php");
        exit();
    } else {
        // Display an error message if there's an issue moving the uploaded file
        echo "Error uploading the file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%; /* Adjust the width of the form as needed */
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="file"] {
            margin-bottom: 16px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size:1.5rem;

        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            position: absolute;
            top: 10px;
            left: 10px;
            text-decoration: none;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size:1.5rem;
        }

        button:hover {
            background-color: #258cd1;
        }
    </style>
</head>
<body>
    <a href="index.php">
        <button>Back to menu</button>
    </a>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="image">Choose Image:</label>
        <input type="file" name="image" id="image" required>
        <br>
        <label for="caption">Caption:</label>
        <input type="text" name="caption" id="caption">
        <br>
        <input type="submit" value="Upload">
    </form>
</body>
</html>
