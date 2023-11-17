<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery PHP</title>

    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px; /* Add margin for separation */
}

a {
    text-decoration: none;
}

button {
    background-color: #3498db;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin: 10px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #4caf50;
}

    </style>


</head>
<body>
    
<h1>Gallery Image Adder & Viewer </h1> 
<br>
<a href="upload.php" >
<button>Add Images</button>
</a>
<a href="gallery.php">
<button> View Images</button>
</a>


</body>
</html>