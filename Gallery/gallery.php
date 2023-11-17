<?php
$conn = mysqli_connect('localhost', 'root', '', 'gallary_db');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM images";
$result = mysqli_query($conn, $sql);
?>

<html>
<head>
    <title>Image Gallery</title>

    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
    text-align: center;
}

h2 {
    font-size: 3rem;
    color: #333;
}

.image-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.image-item {
    margin: 10px;
    text-align: center;
    transition: transform 0.3s ease-in-out;
}

.image-item:hover {
    transform: scale(1.1);
}

.image-item img {
    max-width: 100%;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
}

.image-item:hover img {
    transform: scale(1.1);
}

.image-caption {
    margin-top: 8px;
    color: #555;
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
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
}

button:hover {
    background-color: #258cd1;
}





    </style>




</head>
<body>
    <h2>Image Gallery</h2>

    <a href="index.php">
        <button>Back to menu</button>
    </a>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <!-- Start of a loop that fetches each row of data from the database result -->

    <div style="float: left; margin: 10px;">
        <!-- Start of a container for each image with a left float and margin -->

        <img src="uploads/<?php echo $row['filename']; ?>" alt="<?php echo $row['caption']; ?>" width="200">
        <!-- Displaying the image with its filename and caption from the database -->
        
        <h3><?php echo $row['caption']; ?></h3>
        <!-- Displaying the caption of the image using an H3 heading -->

    </div>
    <!-- End of the container for each image -->

<?php endwhile; ?>
<!-- End of the loop that iterates through each database result row -->


</body>
</html>
